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
       return array('count' => $this->_count('tool', 'tool_uid'));
    }

    function users(){
       return array('count' => $this->_count('user', 'user_uid'));
    }
    
    function facets(){
        return array(
            'Platform' => $this->_count('platform', 'platform_uid'),
            'Keyword' => $this->_count('keyword', 'keyword_uid'),
            'Developer' => $this->_count('developer', 'developer_uid'),
            'Tool type' => $this->_count('tool_type', 'tool_type_uid'),
            'Licence' => $this->_count('licence', 'licence_uid'),
            'Licence type' => $this->_count('licence_type', 'licence_type_uid')
        );
    }
    function _count($table, $count_field){
       $query = "SELECT COUNT(".$count_field.") AS count FROM ".$table;
       $req = $this->DB->prepare($query);
       $req->execute();
       $stats = $req->fetch(PDO::FETCH_ASSOC);
       
       return $stats['count'];
    }    
    
}
$statistics = new Statistics();
?>
