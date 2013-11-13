<?php
class Statistics {
    private static function DB() {
        global $DB;
        return $DB;
    }
    
    static function all(){
        return array(
            'tool' => Statistics::tools(),
            'user' => Statistics::users(),
            'facet' => Statistics::facets()
        );
    }
    
    static function tools(){
       return array('count' => Statistics::_count('tool', 'tool_uid'));
    }

    static function users(){
       return array('count' => Statistics::_count('user', 'user_uid'));
    }
    
    static function facets(){
        return array(
            'Platform' => Statistics::_count('platform', 'platform_uid'),
            'Keyword' => Statistics::_count('keyword', 'keyword_uid'),
            'Developer' => Statistics::_count('developer', 'developer_uid'),
            'Tool type' => Statistics::_count('tool_type', 'tool_type_uid'),
            'License' => Statistics::_count('licence', 'licence_uid'),
            'License type' => Statistics::_count('licence_type', 'licence_type_uid')
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
