<?php

class AdminUser extends User{

	private static function DB() {
		global $DB;
		return $DB;
	}

	static function listAll() {
		
		$result = array();
        $query = "SELECT user_uid, name, mail, login, active, admin FROM user ORDER BY login ASC";
		$req = self::DB()->prepare($query);
		$req->execute();
		$users = $req->fetchAll(PDO::FETCH_ASSOC);
       
		foreach ($users as $user) {
			$result[$user['login']] = $user;
		}
		       
		return $result;		
	}
	
	static function getUserByID($user_uid) {
		
        $query = "SELECT user_uid, name, mail, login, active, admin FROM user WHERE user_uid = $user_uid";
		$req = self::DB()->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
        
		$user['openID'] = $this->getOpenIDForUser($user_uid);
			  
		return $user;		
	}
	
	static function getUserByLogin($login) {
		
        $query = "SELECT user_uid, name, mail, login, active, admin FROM user WHERE login = $login";
		$req = self::DB()->prepare($query);
		$req->execute();
		$user = $req->fetch(PDO::FETCH_ASSOC);
        
		$user['openID'] = getOpenIDForUser($user['user_uid']);
		
		return $user;		
	}
	
	static function getOpenIDForUser($user_uid) {
	
		$result = array();
        $query = "SELECT provider, external_uid FROM user_oauth WHERE user_uid = $user_uid";
		$req = self::DB()->prepare($query);
		$req->execute();
		$openIds = $req->fetchAll(PDO::FETCH_ASSOC);
       
		foreach ($openIds as $openId) {
			$result[$openId['provider']] = $openId;
		}
       
		return $result;			
	}
	
	static function create($name, $mail, $login, $password, $admin) {
	
		try{
			$result = array();
			$query = "INSERT INTO user (name, mail, login, password, active, admin) VALUES ('$name', '$mail', '$login', '$password', 1, $admin)";
			$req = self::DB()->prepare($query);
			$uid = self::DB()->lastInsertId();
			$req->execute();	
		}
		catch (Exception $e)
		{
			return array('danger' => 'An error has occured');
		}
		
		LOG::insert('insert', $_SESSION['user']['id'], 'user', $uid);
		
		return array('success' => 'User created - ' . $login);
	}
		
	static function update($values) {
		
		try{
			if(!empty($values['password'])) {
			
				$query = "UPDATE user SET name=?, mail=?, login=?, password=?, active=?, admin=? WHERE user_uid=?";
				
				$req = self::DB()->prepare($query);
				$req->execute(array($values['name'], $values['mail'], $values['login'], hash('sha256', $values['password']), $values['user_active'], $values['user_admin'], $values['user_uid']));		
			}
			else {
					
				$query = "UPDATE user SET name=?, mail=?, login=?, active=?, admin=? WHERE user_uid=?";
				
				$req = self::DB()->prepare($query);
				$req->execute(array($values['name'], $values['mail'], $values['login'], $values['user_active'], $values['user_admin'], $values['user_uid']));		
			}	
		}
		catch (Exception $e)
		{
			return array('danger' => 'An error has occured');
		}
		
		LOG::insert('update', $_SESSION['user']['id'], 'user', $values['user_uid']);
		
		return array('success' => 'User saved - ' . $values['login']);
	}
	
	static function activate($user_uid, $action) {

        $query = "UPDATE user SET active = '$action' WHERE user_uid = $user_uid";
		$req = self::DB()->prepare($query);
		$req->execute();
		
		LOG::insert('update', $_SESSION['user']['id'], 'user', $user_uid);
	}
}

?>