<?php
$app->get('/', function () use ($rdf, $app) { 
    $app->response->headers->set('Content-Type', 'text/plain');
    print file_get_contents("readme.txt");
});

$app->get('/dump.rdf', function () use ($rdf, $app) { 
    $app->response->headers->set('Content-Type', 'text/xml');
    output_rdf($rdf->all(), 'rdfxml');
});
$app->get('/dump.ttl', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    output_rdf($rdf->all(), 'turtle');
});      
$app->get('/dump.n3', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    output_rdf($rdf->all(),  'n3');
});    
$app->get('/dump.ntriples', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    output_rdf($rdf->all(),  'ntriples');
});  
$app->get('/dump.rdfjson', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'application/json');
    output_rdf($rdf->all(), 'json');
});  

$app->map('/endpoint', function () use ($app) {
    $sparql = new Sparql();
    
    $output         = $app->request->get('output');
    $show_inline    = $app->request->get('show_inline');
    if(isset($output) && !$show_inline){
        switch($output){
            case 'json':
            case 'jsonp':
                $app->response->headers->set('Content-Type', 'application/json');
                break;
            case 'xml':
            case 'rdfxml':
            case '':
                $app->response->headers->set('Content-Type', 'text/xml');
                break;    
            case 'htmltab':
                $app->response->headers->set('Content-Type', 'text/html');
                break;
            default:
                $app->response->headers->set('Content-Type', 'text/plain');
        }
    }
    
    $sparql->endpoint();
})->via('GET', 'POST');

$app->get('/load', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    print_r($rdf->import_to_endpoint());
});

$app->get('/dump', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    print_r($rdf->all());
});

$app->get('/tool/:tool_id(/:format)', function ($tool_id, $format='turtle') use ($rdf, $app) { 
    switch($format){
        case 'n3':
        case 'ntriples':
            $app->response->headers->set('Content-Type', 'text/plain');
            break;
        case 'json':
            $app->response->headers->set('Content-Type', 'application/json');
            break;  
        case 'xml':
        case 'rdfxml':
            $app->response->headers->set('Content-Type', 'text/xml');
            $format = 'rdfxml';  
            break;
        default:
            $app->response->headers->set('Content-Type', 'text/plain');
            $format = 'turtle';
    }
    output_rdf($rdf->tool($tool_id), $format);
});

?>