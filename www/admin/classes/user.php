<?php

class User {

	function __construct() {
		global $DB;
		$this->DB = $DB;
    }

	function listAll() {
		
		$result = array();
        $query = "SELECT user_uid, name, mail, login FROM user ORDER BY login ASC";
		$req = $this->DB->prepare($query);
		$req->execute();
		$users = $req->fetchAll(PDO::FETCH_ASSOC);
       
		foreach ($users as $user) {
			$result[$user['login']] = $user;
		}
       
		return $result;		
	}
	
	function getUserByID($id) {
		
        $query = "SELECT name, mail, login FROM user WHERE user_uid = $id";
		$req = $this->DB->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
              
		return $user;		
	}
	
	function getUserByLogin($login) {
		
        $query = "SELECT name, mail, login FROM user WHERE login = $login";
		$req = $this->DB->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
              
		return $user;		
	}
	
	function getOpenIDForUser($id) {
	
		$result = array();
        $query = "SELECT provider, external_uid FROM user_oauth WHERE user_uid = $id";
		$req = $this->DB->prepare($query);
		$req->execute();
		$openIds = $req->fetchAll(PDO::FETCH_ASSOC);
       
		foreach ($openIds as $openId) {
			$result[$openId['provider']] = $openId;
		}
       
		return $result;			
	}
}
$user = new User();

?>