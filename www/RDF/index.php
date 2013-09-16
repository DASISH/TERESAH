<?php
define("DASISH", true);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";
require_once '../common/SQL.PDO.php';
require '../common/Slim/Slim.php';
require '../common/ARC2/ARC2.php';

#classes
require_once './rdf.php';

function render_ttl($data) {
    $app = \Slim\Slim::getInstance();
    //$app->response->headers->set('Content-Type', 'text/txt');
    
    ob_start();
    include_once("templates/rdf.php");    
    $xml = ob_get_contents();
    ob_end_clean();
    
    $parser = ARC2::getRDFParser();
    $parser->parse('http://tools.dasish.eu', $xml);
    
    $ser = ARC2::getTurtleSerializer();
    
    $triples = $parser->getTriples();
  
    print '<pre>'.$parser->toTurtle($triples).'</pre>';
}

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

require_once './routes.php';

$app->run();
?>