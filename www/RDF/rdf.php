<?php

class Rdf {

    function __construct() {
        #Gettings globals
        global $DB;
        $this->DB = $DB;
    }

    function general($get) {

        $rdfXML = $this->_rdf();
        $namespace = $this->_namespaces();
        
        $this->_tool($rdfXML);
        
        $this->_keyword($rdfXML);


        return $rdfXML;
    }

    function _rdf() {
        $rdfXML = new SimpleXMLElement('<xmlns:rdf:RDF></xmlns:rdf:RDF>', LIBXML_NOERROR, false, 'rdf', true);
        $namespace = $this->_namespaces();

        foreach ($namespace as $k => $val) {
            $rdfXML->registerXPathNamespace($k, $val);
            $rdfXML->addAttribute('xmlns:xmlns:' . $k, $val);
        }

        return $rdfXML;
    }

    function _namespaces() {
        return array(
            'rdfs' => 'http://www.w3.org/2000/01/rdf-schema#',
            'dcterms' => 'http://purl.org/dc/terms/',
            'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'dc' => 'http://purl.org/dc/elements/1.1/',
            'foaf' => 'http://xmlns.com/foaf/0.1/',
            'owl' => 'http://www.w3.org/2002/07/owl#',
            'bibo' => 'http://purl.org/ontology/bibo/',
            'doap' => 'http://usefulinc.com/doap/',
        );
    }
    
    function _prefix(){
        return 'http://tools.dasish.eu/';
    }

    function _tool(&$rdfXML, $id = null) {
        $namespace = $this->_namespaces();
        
        $query = "SELECT t.UID, t.shortname, d.description, d.title, d.homepage FROM Tool t
                      INNER JOIN Description d ON t.UID = d.Tool_UID";

        if($id){
            $query .= " WHERE t.UID = ?";
            $req = $this->DB->prepare($query);
            $req->execute(array($id));
        }else{
            $req = $this->DB->prepare($query);
            $req->execute();            
        }
        
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as &$row) {
            $tool = $rdfXML->addChild('Description', null, $namespace['rdf']);
            $tool->addAttribute('rdf:about', $this->_prefix() . 'tool/' . $row['UID'], $namespace['rdf']);

            $type = $tool->addChild('type', null, $namespace['rdf']);
            $type->addAttribute('rdf:resource', 'http://schema.org/SoftwareApplication', $namespace['rdf']);

            $tool->addChild('identifier', htmlspecialchars($row['shortname']), $namespace['dcterms']);

            $tool->addChild('title', htmlspecialchars($row['title']), $namespace['dc']);
            if ($row['homepage'] && $row['homepage'] != 'Unknown') {
                $tool->addChild('homepage', htmlspecialchars($row['homepage']), $namespace['foaf']);
            }

            if ($row['description'] != '&nbsp;') {
                $tool->addChild('description', htmlspecialchars($row['description']), $namespace['dc']);
            }

            //hasKeyword
            $keywordQuery = "SELECT Tool_UID, Keyword_id FROM tool_has_keyword WHERE Tool_UID =  ?";
            $keywordQuery = $this->DB->prepare($keywordQuery);
            $keywordQuery->execute(array($row["UID"]));
            $keywords = $keywordQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($keywords as &$keyword) {
                $subject = $tool->addChild('subject', null, $namespace['dc']);
                $subject->addAttribute('rdf:resource', $this->_prefix() . 'keyword/' . $keyword['Keyword_id'], $namespace['rdf']);
            }
        }
    }
    
    function _keyword(&$rdfXML){
        $namespace = $this->_namespaces();
        
        $query = "SELECT * FROM keyword";
        $req = $this->DB->prepare($query);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as &$row) {
            $keyword = $rdfXML->addChild('Property', null, $namespace['rdf']);
            $keyword->addAttribute('rdf:about', $this->_prefix() . 'keyword/' . $row['keyword_uid'], $namespace['rdf']);

            $keyword->addChild('label', htmlspecialchars($row['keyword']), $namespace['rdfs']);
            if ($row['sourceURI']) {
                $sameAs = $keyword->addChild('sameAs', null, $namespace['owl']);
                $sameAs->addAttribute('rdf:resource', $row['sourceURI'], $namespace['rdf']);
            }
        }        
    }
}

$rdf = new Rdf();
?>