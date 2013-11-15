<?php

class AdminFacets extends Facets {

	private static function DB() {
		global $DB;
		return $DB;
	}
	
	static function GetAllPlatforms() {
		
		$result = array();
                $query = "SELECT * FROM platform ORDER BY name ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$platforms = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $platforms;			
	}
        
        static function GetPlatformByID ($platform_uid) {
            
            $result = array();
            $query = "SELECT * FROM platform WHERE platform_uid = $platform_uid";
            $req = self::DB()->prepare($query);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        }
                
        static function CreatePlatform($name) {
        		
            try{
                $result = array();
                $query = "INSERT INTO platform (name) VALUES (?)";
                $req = self::DB()->prepare($query);
                $req->execute(array($name));	

                $uid = self::DB()->lastInsertId();
            }
            catch (Exception $e)
            {
                return array('danger' => 'An error has occured');
            }

            //LOG::insert('insert', $_SESSION['user']['id'], 'platform', $uid);

            return array('success' => 'Platform created - ' . $name);
	}
        
        static function UpdatePlatform($platform_uid, $name) {
				
		try{
					
                    $query = "UPDATE platform SET name=? WHERE platform_uid=?";

                    $req = self::DB()->prepare($query);
                    $req->execute(array($name, $platform_uid));	

		}
		catch (Exception $e)
		{
                    return array('danger' => 'An error has occured');
		}
				
		//LOG::insert('update', $_SESSION['user']['id'], 'platform', $platform_uid);
		
		return array('success' => 'Platform saved - ' . $name);
	}
	
	static function GetAllKeywords() {
		
		$result = array();
        $query = "SELECT * FROM keyword
				  ORDER BY keyword ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$keywords = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $keywords;			
	}
	
	static function GetAllDevelopers() {
		
		$result = array();
        $query = "SELECT * FROM developer
				  ORDER BY name ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$developers = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $developers;
	}
	
	static function GetAllToolTypes() {
		
		$result = array();
        $query = "SELECT * FROM tool_type
				  ORDER BY tool_type ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$tool_types = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $tool_types;
	}
	
	static function GetAllLicenses() {
		
		$result = array();
        $query = "SELECT l.licence_uid, l.text, lt.type FROM licence l 
				  INNER JOIN licence_type lt on l.licence_type_uid = lt.licence_type_uid
				  ORDER BY l.text ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$licenses = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $licenses;			
	}
		
	static function GetAllLicenseTypes() {
		
		$result = array();
        $query = "SELECT * FROM licence_type
			      ORDER BY type ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$license_types = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $license_types;			
	}
	
	
}

?>