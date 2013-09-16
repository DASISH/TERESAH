<?php
    $app->get('/dump.rdf', function () use ($rdf, $app) { 
        return xmlP($rdf->all());
    });
?>