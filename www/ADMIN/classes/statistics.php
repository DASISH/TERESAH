<?php
/**
 * Statistics class
 * 
 * Provides summary statistics for users, tools and facets
 * 
 */
class Statistics {
    /**
     * Initiates global variable for db-connection
     * 
     * @global type $DB
     * @return type
     */
    private static function DB() {
        global $DB;
        return $DB;
    }
    
    /**
     * Get all statistics from the database
     * 
     * @return Array Statistics for tool, user and facet
     */
    static function all(){
        return array(
            'tool' => Statistics::tools(),
            'user' => Statistics::users(),
            'facet' => Statistics::facets()
        );
    }
    
    /**
     * @return Array summary statistics for tools
     */
    static function tools(){
       return array('count' => Statistics::_count('tool', 'tool_uid'));
    }

    /**
     * @return Array summary statistics for user
     */
    static function users(){
       return array('count' => Statistics::_count('user', 'user_uid'));
    }
    
    /**
     * @return Array summary statistics for facet
     */    
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
    
    /**
     * Helper function to count number of rows in a table
     * 
     * @param type $table table to count
     * @param type $count_field field to count
     * @return Integer number of rows in table
     */
    private static function _count($table, $count_field){
       $query = "SELECT COUNT(".$count_field.") AS count FROM ".$table;
       $req = self::DB()->prepare($query);
       $req->execute();
       $stats = $req->fetch(PDO::FETCH_ASSOC);
       
       return $stats['count'];
    }
}
?>
