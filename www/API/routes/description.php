<?php
	#print "Description.php is here";
	$app->get('/description/:toolUID', function ($toolUID) use ($tool) { jP($tool->getDescriptions($toolUID)); } );
	$app->post('/description/:toolUID', function ($toolUID) use ($tool, $app) { jP($tool->insertDescription($toolUID, $app->request->post())); } );
?>