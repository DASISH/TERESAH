<?php
class AdminTool {
    private static function DB() {
        global $DB;
        return $DB;
    }
    
    static function listAll(){
        $result = array();
        $query = "SELECT t.tool_uid, t.shortname, d.description, d.title, d.homepage, d.available_from, d.registered, u.name AS user_name FROM tool t
                      INNER JOIN description d ON t.tool_uid = d.tool_uid
                      INNER JOIN user u ON d.user_uid = u.user_uid";
       $req = self::DB()->prepare($query);
       $req->execute();
       $tools = $req->fetchAll(PDO::FETCH_ASSOC);
       
       foreach ($tools as $tool) {
           $result[$tool['shortname']] = $tool;
       }
       
       return $result;
    }
    
    static function getTool($shortname){
        $tool = array();
        
        $query = "SELECT t.tool_uid, t.shortname FROM tool t WHERE t.shortname = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($shortname));
        
        $tool['tool'] = $req->fetch(PDO::FETCH_ASSOC);

        //alternative_title
        $query = "SELECT * FROM alternative_title WHERE tool_uid = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($tool['tool']['tool_uid']));        
        $tool['alternative_title'] = $req->fetchAll(PDO::FETCH_ASSOC);        
        
        //description
        $query = "SELECT * FROM description WHERE tool_uid = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($tool['tool']['tool_uid']));        
        $tool['description'] = $req->fetchAll(PDO::FETCH_ASSOC);
  
        //external_description
        $query = "SELECT * FROM external_description  WHERE tool_uid = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($tool['tool']['tool_uid']));        
        $tool['external_description'] = $req->fetchAll(PDO::FETCH_ASSOC);       
        
        //tool_application_type
        $query = "SELECT * FROM tool_application_type  WHERE tool_uid = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($tool['tool']['tool_uid']));        
        $tool['tool_application_type'] = $req->fetchAll(PDO::FETCH_ASSOC);           

        //load facets
        $facets = array('tool_type', 
                        'suite', 
                        'feature', 
                        'platform', 
                        'keyword', 
                        'project', 
                        'standard', 
                        'publication', 
                        'video', 
                        'developer');
        
        foreach($facets as $facet){
            $tool[$facet] = self::getFacet($tool['tool']['tool_uid'], $facet);  
        }
               
        return $tool;
    }
    
    static function getFacet($tool_uid, $facet){
        $query = "SELECT * FROM ".$facet." INNER JOIN tool_has_".$facet." tt ON tt.".$facet."_uid = ".$facet.".".$facet."_uid WHERE tt.tool_uid = ?";
        $req = self::DB()->prepare($query);
        $req->execute(array($tool_uid));  
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>