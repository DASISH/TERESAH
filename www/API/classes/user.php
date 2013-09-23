<?php
	class User {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
		}
		function login($post) {
			$pw = hash('sha256', $post["password"]);
			try {
				$req = $this->DB->prepare("SELECT Name, Mail FROM User WHERE Login = ? AND Password = ?");
				$req->execute(array($post["user"], $pw));    
			} catch (Exception $e) {
				Die('Need to handle this error. $e has all the details');
			}
			
			if($req->rowCount() == 1) {
				return array("signin" => true, "data" => $req->fetch(PDO::FETCH_ASSOC));
			} else {
				return array("signin" => false);
			}

		}
	}
	$user = new User();
?>