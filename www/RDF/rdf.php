<?php

class Rdf {

    function __construct() {
        #Gettings globals
        global $DB;
        $this->DB = $DB;
        
        #prefixes used for rdf
        $this->pre = array(
            'dasish'    => 'http://tools.dasish.eu/#/',
            'rdf'       => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'rdfs'      => 'http://www.w3.org/2000/01/rdf-schema#',
            'dcterms'   => 'http://purl.org/dc/terms/',
            'foaf'      => 'http://xmlns.com/foaf/0.1/',
            'owl'       => 'http://www.w3.org/2002/07/owl#'
        );
    }

    function all() {
        ini_set('max_execution_time', 120);
        
        return array_merge(
                    $this->tool(), 
                    $this->keyword(),
                    $this->developer()
               );
    }

    function tool($id = null) {
        $result = array();

        $query = "SELECT t.tool_uid, t.shortname, d.description, d.title, d.homepage, d.available_from, d.registered, d.licence_uid FROM tool t
                      INNER JOIN description d ON t.tool_uid = d.tool_uid";

        if ($id) {
            $query .= " WHERE t.shortname = ?";
            $req = $this->DB->prepare($query);
            $req->execute(array($id));
        } else {
            $req = $this->DB->prepare($query);
            $req->execute();
        }

        $tools = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tools as &$tool) {
            $uri = $this->pre['dasish'].'tool/'.$tool['shortname'];
            
            $result[$uri][$this->pre['rdf'].'type'][]           = $this->_val('http://schema.org/SoftwareApplication', 'uri');
            $result[$uri][$this->pre['dcterms'].'identifier'][] = $this->_val($tool['shortname']);
            $result[$uri][$this->pre['dcterms'].'title'][]      = $this->_val(htmlspecialchars($tool['title']));
            $result[$uri][$this->pre['dcterms'].'created'][]    = $this->_val($tool['registered']);
            
            if($tool['homepage'] != 'Unknown'){
                $result[$uri][$this->pre['foaf'].'homepage'][] = $this->_val($tool['homepage'], 'uri');
            }
            
            if($tool['available_from']){  
                $result[$uri][$this->pre['dcterms'].'available'][] = $this->_val(htmlspecialchars($tool['available_from']));
            }
            if($tool['description'] != '&nbsp;'){  
                $result[$uri][$this->pre['dcterms'].'description'][] = $this->_val(htmlspecialchars($tool['description']));
            }
            
            //hasKeyword
            $keywordSQL = "SELECT tool_uid, keyword_uid FROM tool_has_keyword WHERE tool_uid =  ?";
            $keywordQuery = $this->DB->prepare($keywordSQL);
            $keywordQuery->execute(array($tool['tool_uid']));
            $keywords = $keywordQuery->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($keywords as &$keyword) {
                $result[$uri][$this->pre['dcterms'].'subject'][] = $this->_val($this->pre['dasish'].'keyword/'.$keyword['keyword_uid'], 'uri');
                if($id){
                    $result = array_merge($result, $this->keyword($keyword['keyword_uid']));
                }
            }
            
            //hasType
            $toolTypeSQL = "SELECT * FROM tool_type tt INNER JOIN tool_has_tool_type th ON tt.tool_type_uid = th.tool_type_uid WHERE th.tool_uid = ?";
            $toolTypeQuery = $this->DB->prepare($toolTypeSQL);
            $toolTypeQuery->execute(array($tool['tool_uid']));
            $tool_types = $toolTypeQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($tool_types as &$tool_type) {
                $result[$uri][$this->pre['rdf'].'type'][] = $this->_val($tool_type['sourceURI'], 'uri');
                $result[$uri][$this->pre['rdf'].'type'][] = $this->_val($this->pre['dasish'].'tool_type/'.$tool_type['tool_type_uid'], 'uri');
            }
            
            //hasDeveloper
            $developerSQL = "SELECT * FROM tool_has_developer WHERE tool_uid = ?";
            $developerQuery = $this->DB->prepare($developerSQL);
            $developerQuery->execute(array($tool['tool_uid']));
            $developers = $developerQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($developers as &$developer) {  
                $result[$uri][$this->pre['foaf'].'Organization'][] = $this->_val($this->pre['dasish'].'developer/'.$developer['developer_uid'], 'uri');
                if($id){
                    $result = array_merge($result, $this->developer($developer['developer_uid']));
                }
            }
            
            //hasPlatform (using dbpedia)
            $platformSQL = "SELECT * FROM tool_has_platform tp INNER JOIN platform p ON p.platform_uid = tp.platform_id WHERE tool_uid = ?;";
            $platformQuery = $this->DB->prepare($platformSQL);
            $platformQuery->execute(array($tool['tool_uid']));
            $platforms = $platformQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($platforms as &$platform) {
                if($platform['name'] == 'osX'){
                    $platform['name'] = 'OS_X';
                }
                $result[$uri][$this->pre['dcterms'].'requires'][] = $this->_val('http://dbpedia.org/page/'.$platform['platform_platform'], 'uri');
            }
            
            //externalDescription (blank node)
            $external_descriptionSQL = "SELECT * FROM external_description WHERE tool_uid = ?;";
            $external_descriptionQuery = $this->DB->prepare($external_descriptionSQL);
            $external_descriptionQuery->execute(array($tool['tool_uid']));
            $external_descriptions = $external_descriptionQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($external_descriptions as &$external_description) {
                $result[$uri][$this->pre['owl'].'sameAs'][]            = $this->_val($external_description['source_uri'], 'uri');
                $result[$uri][$this->pre['dcterms'].'description'][]   = $this->_val('_:'.$external_description['external_description_uid'], 'bnode');
                
                $result['_:'.$external_description['external_description_uid']][$this->pre['dcterms'].'description'][]   = $this->_val($external_description['description']);
                $result['_:'.$external_description['external_description_uid']][$this->pre['dcterms'].'source'][]        = $this->_val($external_description['source_uri'], 'uri');
            }
        }
        return $result;
    }
    
    function keyword($id = null) {
        $result = array();
        
        $query = "SELECT * FROM keyword";
        if ($id) {
            $query .= " WHERE keyword_uid = ?";
            $req = $this->DB->prepare($query);
            $req->execute(array($id));
        } else {
            $req = $this->DB->prepare($query);
            $req->execute();
        }
        
        $keywords = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($keywords as &$keyword) {
            $uri = $this->pre['dasish'].'keyword/'.$keyword['keyword_uid'];
            
            $result[$uri][$this->pre['rdf'].'type'][]      = $this->_val('http://isocat.org/datcat/DC-278', 'uri');
            $result[$uri][$this->pre['dcterms'].'type'][]  = $this->_val($keyword['source_taxonomy']);
            $result[$uri][$this->pre['rdfs'].'label'][]    = $this->_val(htmlspecialchars($keyword['keyword']));
            $result[$uri][$this->pre['owl'].'sameAs'][]    = $this->_val($keyword['source_uri'], 'uri');
        }
        
        return $result;
    }
    
    function developer($id = null){
        $query = "SELECT * FROM developer";
        if ($id) {
            $query .= " WHERE developer_uid = ?";
            $req = $this->DB->prepare($query);
            $req->execute(array($id));
        } else {
            $req = $this->DB->prepare($query);
            $req->execute();
        }
        
        $developers = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($developers as &$developer) {
            $uri = $this->pre['dasish'].'developer/'.$developer['developer_uid'];
            
            $result[$uri][$this->pre['rdf'].'type'][]      = $this->_val('http://www.isocat.org/datcat/DC-2459', 'uri');
            $result[$uri][$this->pre['foaf'].'name'][]      = $this->_val($developer['name']);
        }       
        return $result;
    }
        
    function _val($value, $type = 'literal'){
        return array('type' => $type, 'value' => $value);
    }
}

$rdf = new Rdf();
?>