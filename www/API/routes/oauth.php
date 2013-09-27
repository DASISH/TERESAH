<?php
	#print "Description.php is here";
	$app->get('/oAuth/Google', function () use ($user, $app) { 
		$app->contentType('application/json');
		print($user->oAuth2($app->request->get(), "google")); 
	} );
	$app->get('/oAuth/Facebook', function () use ($user, $app) { 
		$app->contentType('application/json');
		print($user->oAuth2($app->request->get(), "facebook"));  
	} );
	$app->get('/oAuth/Twitter', function () use ($user, $app) { 
		$app->contentType('application/json');
		print($user->oAuth1($app->request->get(), "twitter")); 
	} );
?>