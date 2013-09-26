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
				$req = $this->DB->prepare("SELECT Name, Mail, UID FROM User WHERE Login = ? AND Password = ?");
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
		function signup($post) {
			if(isset($post["mail"]) && isset($post["password"]) && isset($post["name"]) && isset($post["user"])) {
				$req = "INSERT INTO User VALUES (NULL, ?, ? , ? , ? )";
				$req = $this->DB->prepare($req);
				$req->execute(array($post["name"], $post["mail"], $post["user"], hash("sha256", $post["password"])));
				
				if($req->rowCount() == 1) {
					return array("Success" => "You have now signed up");
				} else {
					return array("Error" => "Error during signin up. Please contact DASISH or retry.");
				}
			} else {
				return array("Error" => "A field is missing");
			}
		}
	}
	$user = new User();
?>