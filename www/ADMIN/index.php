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
require_once '../API/classes/facets.php';
require_once '../common/SQL.PDO.php';
require_once '../common/Slim/Slim.php';
require_once '../common/Slim/Middleware.php';

//oAuth
require_once('../API/assets/oAuth2/vendor/autoload.php');
require_once('../API/assets/oAuth1/vendor/autoload.php');

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->log->setLevel(\Slim\Log::DEBUG);
$app->add(new Slim\Middleware\SessionCookie(array('secret' => 'tools_registry_secret')));

#classes
include 'classes/tool.php';
include 'classes/adminuser.php';
include 'classes/adminfacets.php';
include 'classes/statistics.php';

#routes
include 'routes.php';

#flash messages
include 'flash_messages.php';

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

function is_admin(){
    global $DB;
    $query = "SELECT user_uid, name, mail, login, active, admin FROM user WHERE user_uid = :user_uid";
    $req = $db->prepare($query);    
    if(!isset($_SESSION["user"]["id"])){
        return true;
    }else{
        return false;
    }
}

require_once './routes.php';

$app->run();
?>
