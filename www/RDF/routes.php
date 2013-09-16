<?php
    $app->get('/dump.rdf', function () use ($rdf, $app) { 
        $app->response->headers->set('Content-Type', 'text/xml');
        print $app->render('rdf.php', array('data' => $rdf->all()));
    });
    $app->get('/dump.ttl', function () use ($rdf, $app) {
        render_ttl($rdf->all());
    });      
?>