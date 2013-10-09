<?php
	#print "Description.php is here";
	$app->get('/oAuth/Google', function () use ($user, $app) { 
		$app->contentType('application/json');
		
		$GET = $app->request->get();
		if(isset($GET["callback"])) {
			$_SESSION["callback"] = str_replace("null", "", $GET["callback"]);
		}
		$data = $user->oAuth2($app->request->get(), "google", true);  
		if(isset($data["Location"])) {
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);
				
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				
			}
			$app->redirect($data["Location"]);
		} else {
			$app->contentType('application/json');
			jP($data);
		}
	} );
	$app->get('/oAuth/Facebook', function () use ($user, $app) { 
		$GET = $app->request->get();
		if(isset($GET["callback"])) {
			$_SESSION["callback"] = str_replace("null", "", $GET["callback"]);
		}
		$data = $user->oAuth2($app->request->get(), "facebook", true);  
		if(isset($data["Location"])) {
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);
				
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				
			}
			$app->redirect($data["Location"]);
		} else {
			$app->contentType('application/json');
			jP($data);
		}
	} );
	$app->get('/oAuth/Github', function () use ($user, $app) { 
		$GET = $app->request->get();
		if(isset($GET["callback"])) {
			$_SESSION["callback"] = str_replace("null", "", $GET["callback"]);
		}
		$data = $user->oAuth2($app->request->get(), "github", true);  
		if(isset($data["Location"])) {
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);
				
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				
			}
			$app->redirect($data["Location"]);
		} else {
			$app->contentType('application/json');
			jP($data);
		}
	} );
	$app->get('/oAuth/Twitter', function () use ($user, $app) { 
		$app->contentType('application/json');
		
		$GET = $app->request->get();
		if(isset($GET["callback"])) {
			$_SESSION["callback"] = str_replace("null", "", $GET["callback"]);
		}
		
		$data = $user->oAuth1($app->request->get(), "twitter", true);
		if(isset($data["Location"])) {
			if($data["signin"] == true) {
				$d = $data["data"];
				$app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);
				
				$_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"]);
				
			}
			$app->redirect($data["Location"]);
		} else {
			$app->contentType('application/json');
			jP($data);
		}
	} );
?>