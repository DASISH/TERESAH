<?php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    }
	define("DASISH", true);
	 
	#Require configuration, frameworks, assets 
	require_once "./conf/config.php";
	
	require_once '../common/Slim/Slim.php';
	require_once '../common/PieChart/index.php';
	require_once '../common/SQL.PDO.php';
	
	require_once './classes/index.php';

	#json Print_R
	function jP($array) {
		print(json_encode($array));#, JSON_PRETTY_PRINT));
	}
    
	#Start the framework
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();
	$app->add(new \Slim\Middleware\ContentTypes());


/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

	require_once './routes/index.php';
	header('Content-Type: application/json');
	$app->run();
?>