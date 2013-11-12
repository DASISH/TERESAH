<?php
class Statistics {
    private static function DB() {
        global $DB;
        return $DB;
    }
    
    static function all(){
        return array(
            'tool' => $this->tools(),
            'user' => $this->users(),
            'facet' => $this->facets()
        );
    }
    
    static function tools(){
       return array('count' => $this->_count('tool', 'tool_uid'));
    }

    static function users(){
       return array('count' => $this->_count('user', 'user_uid'));
    }
    
    static function facets(){
        return array(
            'Platform' => $this->_count('platform', 'platform_uid'),
            'Keyword' => $this->_count('keyword', 'keyword_uid'),
            'Developer' => $this->_count('developer', 'developer_uid'),
            'Tool type' => $this->_count('tool_type', 'tool_type_uid'),
            'License' => $this->_count('licence', 'licence_uid'),
            'License type' => $this->_count('licence_type', 'licence_type_uid')
        );
    }
    static function _count($table, $count_field){
       $query = "SELECT COUNT(".$count_field.") AS count FROM ".$table;
       $req = self::DB()->prepare($query);
       $req->execute();
       $stats = $req->fetch(PDO::FETCH_ASSOC);
       
       return $stats['count'];
    }
}
?>
