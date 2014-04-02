<?php
	session_cache_limiter(false);
	session_start();
	/*
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
    */
	
	//oAuth
	require_once('assets/oAuth2/vendor/autoload.php');
	require_once('assets/oAuth1/vendor/autoload.php');
	//End oAuth
		
	define("DASISH", true);
	 
	#Require configuration, frameworks, assets 
	require_once "./conf/config.php";
	
	require_once '../common/Slim/Slim.php';
	require_once '../common/PieChart/index.php';
	require_once '../common/SQL.PDO.php';
	
	require_once './classes/requires.php';

	#json Print_R
	function jP($variables = false, $methods = "OPTIONS, GET, POST", $status = false) {
		$app = Slim\Slim::getInstance();
		$app->contentType('application/json');
		$response = $app->response();
		$response->header('Access-Control-Allow-Origin', '*');
		$response->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, X-authentication, X-client');
		$response->header('Access-Control-Allow-Methods', $methods);

		if($status != false) {
			$app->response()->status($status);
		}
		if($variables !== false) {
			echo json_encode($variables);
		}
		return true;
	}
    
	#Start the framework
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim(
			array(
                          'debug'=>true,
		'cookies.encrypt' => true,
		'cookies.secret_key' => '(ecwccx_)4q8f3q^3vsq)@0l%v=y%r390%ke+l7pjdwj75v8f)fp@ba2#1z7)eyjl!-3y2mb@*euaaf+*5+4r(!9iw2w)o1akx!w+8x^#y+y5kureo5!4q6a8*44_r($plnkqi$d9k-(s@zwlgwa34',
		'cookies.cipher' => MCRYPT_RIJNDAEL_256,
		'cookies.cipher_mode' => MCRYPT_MODE_CBC
	));
	
	$app->add(new \Slim\Middleware\ContentTypes());
	
	// require_once './routes/index.php';
	require_once './routes/tool.php';
	require_once './routes/facet.php';
	require_once './routes/search.php';
	require_once './routes/pie.php';
	require_once './routes/login.php';
	require_once './routes/oauth.php';
	require_once './routes/forum.php';
	require_once './routes/faq.php';
        require_once './routes/profile.php';
        require_once './routes/user.php';

	$app->run();
?>