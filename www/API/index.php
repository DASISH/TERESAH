<?php
	session_cache_limiter(false);
	session_start();
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
	/*
	function find_all_files($dir)
	{
		$root = scandir($dir);
		$result = array();
		foreach($root as $value)
		{
			if($value === '.' || $value === '..') {continue;}
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
			foreach(find_all_files("$dir/$value") as $value)
			{
				$result[]=$value;
			}
		}
		return $result;
	}
	*/
	//oAuth
	//require_once('assets/oAuth2/vendor/autoload.php');
	//require_once('assets/oAuth1/vendor/autoload.php');
	//End oAuth
		
	define("DASISH", true);
	 
	#Require configuration, frameworks, assets 
	require_once "./conf/config.php";
	
	require_once '../common/Slim/Slim.php';
	require_once '../common/PieChart/index.php';
	require_once '../common/SQL.PDO.php';
	
	require_once './classes/index.php';

	#json Print_R
	function jP($array, $session = true) {
		/*
		if($session == true) {
			if(isset($_SESSION["user"])) {
				$array = array("data" => $array, "user" => $_SESSION["user"]);
			} else {
				$array = array("data" => $array, "user" => false);
			}
		}
		*/
		print(json_encode($array));#, JSON_PRETTY_PRINT));
	}
    
	#Start the framework
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim(
			array(
		'cookies.encrypt' => true,
		'cookies.secret_key' => '(ecwccx_)4q8f3q^3vsq)@0l%v=y%r390%ke+l7pjdwj75v8f)fp@ba2#1z7)eyjl!-3y2mb@*euaaf+*5+4r(!9iw2w)o1akx!w+8x^#y+y5kureo5!4q6a8*44_r($plnkqi$d9k-(s@zwlgwa34',
		'cookies.cipher' => MCRYPT_RIJNDAEL_256,
		'cookies.cipher_mode' => MCRYPT_MODE_CBC
	));
	/*
	$app->add(new \Slim\Middleware\SessionCookie(array(
		'expires' => '20 minutes',
		'path' => '/',
		'domain' => null,
		'secure' => false,
		'httponly' => false,
		'name' => 'slim_session',
		'secret' => 'zxcvtgbujnmxefvtgbunihjxsrdhnws4e5d6rfthyuj3se5dugbvthyycesvtdrbfyvhrjbdfrtjsxetsyefbybkttf',
		'cipher' => MCRYPT_RIJNDAEL_256,
		'cipher_mode' => MCRYPT_MODE_CBC
	)));
	*/
	$app->add(new \Slim\Middleware\ContentTypes());
	
	/*
	function authenticate(\Slim\Route $route) {
		$app = \Slim\Slim::getInstance();
		if (isAuthentificated() === false) {
			$app->halt(401);
		}
	}
	*/

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