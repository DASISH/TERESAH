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

function output_rdf($data, $format){
    $graph = new EasyRdf_Graph('http://tools.dasish.eu/#/');
    $graph->parse($data, 'php', 'http://tools.dasish.eu/#/');
    
    $output_format = EasyRdf_Format::getFormat($format);
    print $graph->serialise($output_format);
}

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

require_once './routes.php';

$app->run();
?>