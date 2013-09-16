<?php
	$app->get('/rdf', function () use ($rdf, $app) { 
		return xmlP($rdf->all()); 
	});
        $app->get('/katt', function () use ($rdf, $app) { 
		print "katt";
	});
?>