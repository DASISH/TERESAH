<?php
define("DASISH", true);

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";
require_once '../common/SQL.PDO.php';
require '../common/Slim/Slim.php';

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->log->setLevel(\Slim\Log::DEBUG);

#classes
include 'classes/tool.php';

#routes
include 'routes.php';

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