<?php
	#print "Description.php is here";
	$app->get('/tool/:toolUID', function ($toolUID) use ($tool, $app) { 
		$app->contentType('application/json');
		jP($tool->getTool($toolUID, $app->request->get())); 
	} );
?>