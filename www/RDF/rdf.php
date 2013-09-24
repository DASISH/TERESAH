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
                    $this->keyword()
               );
    }

    function tool($id = null) {
        $result = array();

        $query = "SELECT t.UID, t.shortname, d.description, d.title, d.homepage, d.available_from, d.registered, d.Licence_UID FROM Tool t
                      INNER JOIN Description d ON t.UID = d.Tool_UID";

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
            $keywordSQL = "SELECT Tool_UID, Keyword_id FROM tool_has_keyword WHERE Tool_UID =  ?";
            $keywordQuery = $this->DB->prepare($keywordSQL);
            $keywordQuery->execute(array($tool['UID']));
            $keywords = $keywordQuery->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($keywords as &$keyword) {
                $result[$uri][$this->pre['dcterms'].'subject'][] = $this->_val($this->pre['dasish'].'keyword/'.$keyword['Keyword_id'], 'uri');
                if($id){
                    $result = array_merge($result, $this->keyword($keyword['Keyword_id']));
                }
            }
            
            //hasType
            $toolTypeSQL = "SELECT * FROM tool_type tt INNER JOIN tool_has_tool_type th ON tt.tool_type_uid = th.tool_type_uid WHERE th.Tool_UID = ?";
            $toolTypeQuery = $this->DB->prepare($toolTypeSQL);
            $toolTypeQuery->execute(array($tool['UID']));
            $tool_types = $toolTypeQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($tool_types as &$tool_type) {
                $result[$uri][$this->pre['rdf'].'type'][] = $this->_val($tool_type['sourceURI'], 'uri');
                $result[$uri][$this->pre['rdf'].'type'][] = $this->_val($this->pre['dasish'].'tool_type/'.$tool_type['tool_type_uid'], 'uri');
            }
            
            //hasPlatform (using dbpedia)
            $platformSQL = "SELECT * FROM tool_has_platform WHERE Tool_UID = ?;";
            $platformQuery = $this->DB->prepare($platformSQL);
            $platformQuery->execute(array($tool['UID']));
            $platforms = $platformQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($platforms as &$platform) {
                if($platform['Platform_platform'] == 'osX'){
                    $platform['Platform_platform'] = 'OS_X';
                }
                $result[$uri][$this->pre['dcterms'].'requires'][] = $this->_val('http://dbpedia.org/page/'.$platform['Platform_platform'], 'uri');
            }
            
            //externalDescription (blank node)
            $external_descriptionSQL = "SELECT * FROM external_description WHERE Tool_UID = ?;";
            $external_descriptionQuery = $this->DB->prepare($external_descriptionSQL);
            $external_descriptionQuery->execute(array($tool['UID']));
            $external_descriptions = $external_descriptionQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($external_descriptions as &$external_description) {
                $result[$uri][$this->pre['owl'].'sameAs'][]            = $this->_val($external_description['sourceURI'], 'uri');
                $result[$uri][$this->pre['dcterms'].'description'][]   = $this->_val('_:'.$external_description['UID'], 'bnode');
                
                $result['_:'.$external_description['UID']][$this->pre['dcterms'].'description'][]   = $this->_val($external_description['description']);
                $result['_:'.$external_description['UID']][$this->pre['dcterms'].'source'][]        = $this->_val($external_description['sourceURI'], 'uri');
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
            $result[$uri][$this->pre['dcterms'].'type'][]  = $this->_val($keyword['sourceTaxonomy']);
            $result[$uri][$this->pre['rdfs'].'label'][]    = $this->_val(htmlspecialchars($keyword['keyword']));
            $result[$uri][$this->pre['owl'].'sameAs'][]    = $this->_val($keyword['sourceURI'], 'uri');
        }
        
        return $result;
    }
        
    function _val($value, $type = 'literal'){
        return array('type' => $type, 'value' => $value);
    }
}

$rdf = new Rdf();
?>