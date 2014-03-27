<?php


define("DASISH", true);

define('ARC2_db_host', 'localhost');
define('ARC2_db_name', 'arc2');
define('ARC2_db_user', 'arc2');
define('ARC2_db_pwd', 'hejsan');



#Require configuration, frameworks, assets 
require_once("../API/conf/config.php");
require_once('../common/SQL.PDO.php');
require('../common/Slim/Slim.php');
require('../common/EasyRdf/EasyRdf.php');
require('../common/ARC2/ARC2.php');

#classes
require_once('rdf.php');
require_once('sparql.php');

function output_rdf($data, $format){
    $graph = new EasyRdf_Graph('http://wp23.borsna.se/#/');
    $graph->parse($data, 'php', 'http://wp23.borsna.se/#/');

    $output_format = EasyRdf_Format::getFormat($format);
    print $graph->serialise($output_format);
}

#Start the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array(
                'mode' => 'development',
                'debug' => true
            ));

require_once('routes.php');

$app->run();
?>