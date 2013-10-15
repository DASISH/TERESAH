<?php
class Statistics {
    function __construct() {
            global $DB;
            $this->DB = $DB;
    }
    function all(){
        return array(
            'tool' => $this->tools()
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
}
$statistics = new Statistics();
?>
