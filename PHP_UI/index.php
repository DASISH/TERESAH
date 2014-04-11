<?php
define("DASISH", true);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";


require_once '../API/classes/log.php';
require_once '../API/classes/user.php';
require_once '../API/classes/descriptions.php';
require_once '../API/classes/tool.php';
require_once '../API/classes/facets.php';
require_once '../API/classes/api.php';
require_once '../API/classes/helper.php';
require_once '../common/SQL.PDO.php';
require_once '../common/Slim/Slim.php';
require_once '../common/Slim/Middleware.php';



//oAuth
require_once('../API/assets/oAuth2/vendor/autoload.php');
require_once('../API/assets/oAuth1/vendor/autoload.php');

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug'=>true));

$app->log->setLevel(\Slim\Log::DEBUG);
$app->add(new Slim\Middleware\SessionCookie(array('secret' => 'tools_registry_secret')));

session_cache_limiter(false);
session_start();

if(MODE != "Test"){
    if(!isset($_SESSION['user'])) {
        //redirect to login page
        $app->redirect('/login');
        die();
    }
    else if ($_SESSION['user']['level'] != '4') {
        $app->halt(403, "You don't have permission to view this page");
    }
}


#routes
include('routes/tool.php');

/**
 * Render all content in the main.php template using
 * a inner template
 * 
 * @param string $template name of template
 * @param string $variables variables to pass to template
 */
function display($template, $variables) {
		
    $app = Slim\Slim::getInstance();
    ob_start();
    $app->render($template, $variables);
    $content = ob_get_clean();	
    $app->render('main.php', array('content' => $content));
}


$app->run();
?>