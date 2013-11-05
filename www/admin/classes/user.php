<?php

class User {

	function __construct() {
		global $DB;
		$this->DB = $DB;
    }

	function listAll() {
		
		$result = array();
        $query = "SELECT user_uid, name, mail, login, active FROM user ORDER BY login ASC";
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
		
        $query = "SELECT user_uid, name, mail, login, active FROM user WHERE login = $login";
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
	
		print 'create';
	
		$app = Slim\Slim::getInstance();
		
		try{
			$result = array();
			$query = "INSERT INTO user (name, mail, login, password, active) VALUES ('$name', '$mail', '$login', '$password', 1)";
			$req = $this->DB->prepare($query);
			$req->execute();	
		}
		catch (Exception $e)
		{
			return array('danger' => 'An error has occured');
		}
		return array('success' => 'User created - ' . $login);
	}
		
	function update($values) {
		
		print 'update';
		
		$app = Slim\Slim::getInstance();
		
		try{
			if(!empty($values['password'])) {
			
				$query = "UPDATE user SET name=?, mail=?, login=?, password=?, active=? WHERE user_uid=?";
				
				$req = $this->DB->prepare($query);
				$req->execute(array($values['name'], $values['mail'], $values['login'], hash('sha256', $values['password']), $values['user_active'], $values['user_uid']));		
			}
			else {
					
				$query = "UPDATE user SET name=?, mail=?, login=?, active=? WHERE user_uid=?";
				
				$req = $this->DB->prepare($query);
				$req->execute(array($values['name'], $values['mail'], $values['login'], $values['user_active'], $values['user_uid']));		
			}	
		}
		catch (Exception $e)
		{
			return array('danger' => 'An error has occured');
		}
		return array('success' => 'User saved - ' . $values['login']);
	}
	
	function activate($user_uid, $action) {

        $query = "UPDATE user SET active = '$action' WHERE user_uid = $user_uid";
		$req = $this->DB->prepare($query);
		$req->execute();
	}
}
$user = new User();

?>