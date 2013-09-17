<?php
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
$app->get('/dump.rdfjson', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'application/json');
    output_rdf($rdf->all(), 'json');
});  

$app->get('/dump', function () use ($rdf, $app) {
    $app->response->headers->set('Content-Type', 'text/plain');
    print_r($rdf->all());
});

$app->get('/tool/:tool_id(/:format)', function ($tool_id, $format='rdfxml') use ($rdf, $app) { 
    switch($format){
        case 'turtle':
        case 'n3':
            $app->response->headers->set('Content-Type', 'text/plain');
            output_rdf($rdf->_tool($tool_id), $format);
            break;
        case 'json':
            $app->response->headers->set('Content-Type', 'application/json');
            output_rdf($rdf->_tool($tool_id), $format);
            break;        
        default:
            $app->response->headers->set('Content-Type', 'text/xml');
            output_rdf($rdf->_tool($tool_id), 'rdfxml');
    }
});

?>