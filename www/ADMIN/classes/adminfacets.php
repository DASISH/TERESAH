<?php

class AdminFacets extends Facets {

	private static function DB() {
		global $DB;
		return $DB;
	}
	
	static function GetAllPlatforms() {
		
		$result = array();
        $query = "SELECT * FROM platform
				  ORDER BY name ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$platforms = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $platforms;			
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