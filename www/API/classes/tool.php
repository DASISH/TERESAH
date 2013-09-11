<?php
	class Tool {
	
		##Getting DB
		function __construct() {
			global $DB;
			$this->DB = $DB;
		}
		
		function getDescriptions($toolUID) {
			$req = $this->DB->prepare("SELECT * FROM External_Description WHERE Tool_UID = ? ");
			$req->execute(array($toolUID));
			return json_encode($req->fetchAll());
		}
	}
	$tool = new Tool();
?>