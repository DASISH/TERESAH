<?php
	define("DASISH", true);
	 
	#Require configuration, frameworks, assets 
	require_once "./conf/config.php";
	
	require 'Slim/Slim.php';
	require_once './assets/index.php';
	require_once './classes/index.php';

	#json Print_R
	function jP($array) {
		print_r(json_encode($array));#, JSON_PRETTY_PRINT));
	}
	#Start the framework
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();


/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

	require_once './routes/index.php';
	
	$app->run();
?>