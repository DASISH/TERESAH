<?php
	class User {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
		}
		function login($post) {
			$pw = hash('sha256', $post->password);
			
			try {
			$req = $this->DB->prepare("SELECT * FROM User WHERE Name = ? ");
			$req->execute(array("Thibault"));     
			} catch (Exception $e) {
				Die('Need to handle this error. $e has all the details');
			}
			
			//$req = $this->DB->prepare("SELECT u.name, u.mail FROM User u WHERE u.Login = 'titi' AND u.Password = '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5'");
			// $req->execute();
			return array($req->rowCount(),$req->fetch(PDO::FETCH_ASSOC), array($post->user, hash('sha256', $post->password)));
			/*
			if($req->rowCount() == 1) {
				return array("signin" => true, "data" => $req->fetch(PDO::FETCH_ASSOC));
			} else {
				return array("signin" => false);
			}*/
		}
	}
	$user = new User();
?>