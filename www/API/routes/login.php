<?php
	$app->map('/login/', function () use ($app, $user) {
		// Don't forget to set the correct attributes in your form (name="user" + name="password")
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$app->response()->status(400);
		}
		
		if(isset($input["user"]) && isset($input["password"]))
		{
			$data = $user->login($input);
			
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setEncryptedCookie('t23-p', hash("sha256", $input["password"]), "2 days");
				$app->setEncryptedCookie('t23-u',$input["user"], "2 days");
				$app->setEncryptedCookie('t23-i',$d["UID"], "2 days");
				$app->setCookie('logged',$d["Name"], "20 minutes");
				
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				
				return jP($d);
			} else {
				return jP($data);
			}
			
		}
		else
		{
			$app->response()->status(401);
		}
	})->via('POST')->name('login');
	
	$app->map('/signup/', function () use ($app, $user) {
		// Don't forget to set the correct attributes in your form (name="user" + name="password")
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$app->response()->status(400);
		}
		
		if(isset($input["mail"]) && isset($input["password"]) && isset($input["name"]) && isset($input["user"]))
		{
			$data = $user->signup($input);
			
			if(isset($data["Success"])) {
				return jP($data);
			} else {
				return jP($data);
			}
		}
		else
		{
			$app->response()->status(401);
		}
	})->via('POST')->name('signup');

	$app->get('/cookie/', function () use ($app) { 
		if(isset($_SESSION["user"])) {
			return jP($_SESSION["user"]);
		} else {
			return jP(array("Error" => "Not connected"));
		}
	} );
	
	$app->get('/signout/', function () use ($app) { 
		session_destroy();
		$app->setEncryptedCookie('t23-p', false, "1 second");
		$app->setEncryptedCookie('t23-u',false, "1 second");
		$app->setEncryptedCookie('t23-i',false, "1 second");
		$app->setCookie('logged', false, "1 second");
		return jP(array("signedout" => false));
	} );
	/*
	$authAdmin = function  ( $role = 'member') {

		return function () use ( $role ) {
			if($_SESSION["user"]["id"]) {
				return true;
			} else {
				return false;
			}
		/*
			$app = Slim::getInstance('my_cookie');

			// Check for password in the cookie
			if($app->getEncryptedCookie('my_cookie',false) != 'YOUR_PASSWORD'){

				$app->redirect('/login');
			}
		};

	};
	*/
?>