<?php
	$app->map('/login/', function () use ($app, $require) {
		// Don't forget to set the correct attributes in your form (name="user" + name="password")
		$require->req(array("user", "log"));
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$app->response()->status(400);
		}
		
		if(isset($input["user"]) && isset($input["password"]))
		{
			$data = User::login($input);
			
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setEncryptedCookie('t23-p', hash("sha256", $input["password"]), "2 days");
				$app->setEncryptedCookie('t23-u',$input["user"], "2 days");
				$app->setEncryptedCookie('t23-i',$d["UID"], "2 days");
				$app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);
				
                                $keys = User::getAPIKeysForID($d["UID"]);
                                $d["Keys"] = $keys;
                                
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"], "level" => $d["Level"], "keys" => $keys);
				
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
	
	$app->map('/signup/', function () use ($app, $require) {
		$require->req(array("user", "log"));
		// Don't forget to set the correct attributes in your form (name="user" + name="password")
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$app->response()->status(400);
		}
		                 
                $data = User::signup($input);
                return jP($data);
               
	})->via('POST')->name('signup');

	$app->get('/cookie/', function () use ($app) { 
		if(isset($_SESSION["user"])) {
			return jP($_SESSION["user"]);
		} else {
			return jP(array("status" => "error", "message" => "Not connected"));
		}
	} );
	
	$app->get('/signout/', function () use ($app) { 
		session_destroy();
		$app->setEncryptedCookie('t23-p', false, "1 second", "/",  COOKIE_DOMAIN);
		$app->setEncryptedCookie('t23-u',false, "1 second", "/",  COOKIE_DOMAIN);
		$app->setEncryptedCookie('t23-i',false, "1 second", "/",  COOKIE_DOMAIN);
		$app->setCookie('logged', false, "1 second", "/",  COOKIE_DOMAIN);
		return jP(array("signedout" => false));
	} );
?>