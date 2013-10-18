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
	
	function getUserByID($user_uid) {
		
        $query = "SELECT user_uid, name, mail, login FROM user WHERE user_uid = $user_uid";
		$req = $this->DB->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
        
		$user['openID'] = $this->getOpenIDForUser($user_uid);
			  
		return $user;		
	}
	
	function getUserByLogin($login) {
		
        $query = "SELECT user_uid, name, mail, login FROM user WHERE login = $login";
		$req = $this->DB->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
        
		$user['openID'] = getOpenIDForUser($user['user_uid']);
		
		return $user;		
	}
	
	function getOpenIDForUser($user_uid) {
	
		$result = array();
        $query = "SELECT provider, external_uid FROM user_oauth WHERE user_uid = $user_uid";
		$req = $this->DB->prepare($query);
		$req->execute();
		$openIds = $req->fetchAll(PDO::FETCH_ASSOC);
       
		foreach ($openIds as $openId) {
			$result[$openId['provider']] = $openId;
		}
       
		return $result;			
	}
	
	function create($name, $mail, $login, $password) {
	
		$result = array();
        $query = "INSERT INTO user (name, mail, login, password) VALUES ('$name', '$mail', '$login', '$password')";
		$req = $this->DB->prepare($query);
		$req->execute();	
	}
	
	function update($values) {
		
		print $values['user_uid'];
		
		if(!empty($values['password'])) {
		
			$query = "UPDATE user SET name=?, mail=?, login=?, password=? WHERE user_uid=?";
			
			$req = $this->DB->prepare($query);
			$req->execute(array($values['name'], $values['mail'], $values['login'], hash('sha256', $values['password']), $values['user_uid']));		
		}
		else {
				
			$query = "UPDATE user SET name=?, mail=?, login=? WHERE user_uid=?";
			
			$req = $this->DB->prepare($query);
			$req->execute(array($values['name'], $values['mail'], $values['login'], $values['user_uid']));		
		}		
	}
	
	function activate($user_uid, $action) {

        $query = "UPDATE user SET active = '$action' WHERE user_uid = $user_uid";
		$req = $this->DB->prepare($query);
		$req->execute();
	}
}
$user = new User();

?>