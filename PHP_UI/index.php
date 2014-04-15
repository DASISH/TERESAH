<?php
define("DASISH", true);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";


require_once '../API/classes/log.php';
require_once '../API/classes/user.php';
require_once '../API/classes/descriptions.php';
require_once '../API/classes/tool.php';
require_once '../API/classes/facets.php';
require_once '../API/classes/search.php';
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
include('routes/info.php');
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
    
    $dummyUser = array('signin' => true, 'data'=> array('level' => 1, 'Name'=>'Kalle Anka'));
    
    ob_start();
    $variables['i18n'] = i18nParse(getPreferedLanguage());
    $app->render($template, $variables);
    $content = ob_get_clean();	
    $app->render('main.php', array('content' => $content, 'user' => $dummyUser));
}

$app->run();

/**
 * Detects the prefered language of the defined i18n files
 * 
 * @return prefered language string
 */
function getPreferedLanguage(){
    $langs = array();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        // break up string into pieces (languages and q factors)
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

        if (count($lang_parse[1])) {
            // create a list like "en" => 0.8
            $langs = array_combine($lang_parse[1], $lang_parse[4]);

            // set default to 1 for any without q factor
            foreach ($langs as $lang => $val) {
                if ($val === '') $langs[$lang] = 1;
            }

            // sort list based on value	
            arsort($langs, SORT_NUMERIC);
        }
    }else{
        $langs = array('en'=>1);
    }

    // look through sorted list and use first one that matches our languages
    foreach ($langs as $lang => $val) {
        if(file_exists('assets/i18n/'.$lang.'.js')){
            return $lang;
        }
    }    
}

/**
 * Parse the i18n js-file
 * 
 * @param type $lang language to read
 * @return array of i18n keys
 */
function i18nParse($lang){
    $str = file_get_contents('assets/i18n/'.$lang.'.js');
    $str = explode('{', $str);
    if (isset($str[1])){
        $str = explode('}', $str[1]);
        $str =  $str[0];
    }
    return json_decode('{'.str_replace("'", '"', $str).'}', true);
}
?>