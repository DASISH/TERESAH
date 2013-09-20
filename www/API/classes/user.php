<?php
	class User {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
		}
		function login($post) {
			$req = "SELECT u.name, u.mail FROM User u WHERE u.Login = ? AND u.Password = ? LIMIT 1";
			$req = $this->DB->prepare($req);
			$req->execute(array($post->user, hash('sha256', $post->password)));
			return array($req->fetch(PDO::FETCH_ASSOC), array($post->user, hash('sha256', $post->password)));
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