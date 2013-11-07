<?php
define("DASISH", true);

define("BASE_PATH", '/admin/');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";
require_once '../API/classes/log.php';
require_once '../API/classes/user.php';
require_once '../common/SQL.PDO.php';
require_once '../common/Slim/Slim.php';
require_once '../common/Slim/Middleware.php';

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->log->setLevel(\Slim\Log::DEBUG);
$app->add(new Slim\Middleware\SessionCookie(array('secret' => 'tools_registry_secret')));

#classes
include 'classes/tool.php';
include 'classes/adminuser.php';
include 'classes/statistics.php';

#routes
include 'routes.php';

#flash messages
include 'flash_messages.php';

#helper function, displays output in main.php
function display($template, $variables) {
		
    $app = Slim\Slim::getInstance();
    ob_start();
    $app->render($template, $variables);
    $content = ob_get_clean();	
    $app->render('main.php', array('content' => $content));
}

require_once './routes.php';

$app->run();
?>
