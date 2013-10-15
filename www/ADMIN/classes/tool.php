<?php
class Tool {
    function __construct() {
            global $DB;
            $this->DB = $DB;
    }
    function listAll(){
        $result = array();
        $query = "SELECT t.tool_uid, t.shortname, d.description, d.title, d.homepage, d.available_from, d.registered, u.name AS user_name, d.Licence_uid FROM tool t
                      INNER JOIN description d ON t.tool_uid = d.tool_uid
                      INNER JOIN user u ON d.user_uid = u.user_uid";
       $req = $this->DB->prepare($query);
       $req->execute();
       $tools = $req->fetchAll(PDO::FETCH_ASSOC);
       
       foreach ($tools as $tool) {
           $result[$tool['shortname']] = $tool;
       }
       
       return $result;
    }
}
$tool = new Tool();
?>
