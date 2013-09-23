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
			
			$app->setCookie('mycookie',$input["password"], "2 days");
			if($data["signin"] == true) {
				$app->setEncryptedCookie('t23-p',$input["password"], "2 days");
				$app->setEncryptedCookie('t23-u',$input["user"], "2 days");
				return jP($data["data"]);
			}
			
		}
		else
		{
			$app->response()->status(401);
		}
	})->via('POST')->name('login');

	$app->get('/cookie/', function () use ($app) { 
		$cookies = $app->getEncryptedCookie('t23-p');
		
		return jP($cookies);
	} );
	
	/*
	$authAdmin = function  ( $role = 'member') {

		return function () use ( $role ) {

			$app = Slim::getInstance('my_cookie');

			// Check for password in the cookie
			if($app->getEncryptedCookie('my_cookie',false) != 'YOUR_PASSWORD'){

				$app->redirect('/login');
			}
		};
	};
	*/
?>