<?php
	$app->get('/rdf', function () use ($rdf, $app) { 
		return xmlP($rdf->general($app->request->get())); 
	});
?>