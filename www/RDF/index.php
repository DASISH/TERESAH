<?php
define("DASISH", true);

#Require configuration, frameworks, assets 
require_once "../API/conf/config.php";
require_once '../common/SQL.PDO.php';
require '../common/Slim/Slim.php';
require '../common/ARC2/ARC2.php';
require '../common/EasyRdf/EasyRdf.php';

#classes
require_once './rdf.php';

function render_ttl($data) {
    $app = \Slim\Slim::getInstance();
    $app->response->headers->set('Content-Type', 'text/plain');
    
    ob_start();
    include_once("templates/rdf.php");    
    $xml = ob_get_contents();
    ob_end_clean();
        
    
    $graph = new EasyRdf_Graph('http://tools.dasish.eu');
    $graph->parse($xml, 'rdfxml', 'http://tools.dasish.eu');
    
    $format = EasyRdf_Format::getFormat('turtle');
    
    print $graph->serialise($format);
    
}

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

require_once './routes.php';

$app->run();
?>