<?php

class Rdf {

    function __construct() {
        #Gettings globals
        global $DB;
        $this->DB = $DB;
    }

    function all() {
        $result = array();
        $result['tools'] = $this->_tool();
        $result['keywords'] = $this->_keyword();

        return $result;
    }

    function _prefix() {
        return 'http://tools.dasish.eu/';
    }

    function _tool($id = null) {
        $tools = array();

        $query = "SELECT t.UID, t.shortname, d.description, d.title, d.homepage, d.available_from, d.registered FROM Tool t
                      INNER JOIN Description d ON t.UID = d.Tool_UID";

        if ($id) {
            $query .= " WHERE t.UID = ?";
            $req = $this->DB->prepare($query);
            $req->execute(array($id));
        } else {
            $req = $this->DB->prepare($query);
            $req->execute();
        }

        $tools = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tools as &$t) {
            //hasKeyword
            $keywordQuery = "SELECT Tool_UID, Keyword_id FROM tool_has_keyword WHERE Tool_UID =  ?";
            $keywordQuery = $this->DB->prepare($keywordQuery);
            $keywordQuery->execute(array($t["UID"]));
            $t['keywords']= $keywordQuery->fetchAll(PDO::FETCH_ASSOC);
        }
        return $tools;
    }

    function _keyword() {
        $query = "SELECT * FROM keyword";
        $req = $this->DB->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

$rdf = new Rdf();
?>