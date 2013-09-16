<?php	 
	#Require configuration, frameworks, assets 
	require_once "../API/conf/config.php";
	require_once '../API/assets/index.php';
	require '../API/Slim/Slim.php';
	
	#classes
	require_once './rdf.php';

	function xmlP($xml){
		$app = \Slim\Slim::getInstance();
		$app->response->headers->set('Content-Type', 'text/xml');
		print $xml->asXML();
	}
	#Start the framework
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();

	require_once './routes.php';
	
	$app->run();
?>