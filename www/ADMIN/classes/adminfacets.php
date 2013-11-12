<?php

class AdminFacets extends Facets {

	private static function DB() {
		global $DB;
		return $DB;
	}

	static function GetLicenses() {
		
		$result = array();
        $query = "SELECT l.licence_uid, l.text, lt.type FROM licence l 
				  INNER JOIN licence_type lt on l.licence_type_uid = lt.licence_type_uid
				  ORDER BY l.text ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$licenses = $req->fetchAll(PDO::FETCH_ASSOC);
       		       
		return $licenses;			
	}
	
	
	
}

?>