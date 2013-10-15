<?php
class Statistics {
    function __construct() {
            global $DB;
            $this->DB = $DB;
    }
    function all(){
        return array(
            'tool' => $this->tools(),
            'user' => $this->users(),
            'facet' => $this->facets()
        );
    }
    
    function tools(){
       $result = array();
       $query = "SELECT COUNT(tool_uid) AS count FROM tool";
       $req = $this->DB->prepare($query);
       $req->execute();
       $tools = $req->fetch(PDO::FETCH_ASSOC);
       
       $result['count'] = $tools['count'];
       
       
       return $result;
    }

    function users(){
       $result = array();
       $query = "SELECT COUNT(user_uid) AS count FROM user";
       $req = $this->DB->prepare($query);
       $req->execute();
       $users = $req->fetch(PDO::FETCH_ASSOC);
       
       $result['count'] = $users['count'];
       
       
       return $result;
    }    
    
    function facets(){
        include('../API/classes/0.table.php');
        include('../API/classes/search.php');
        $result = $search->getFacets();
        return $result;
    }
    
}
$statistics = new Statistics();
?>
