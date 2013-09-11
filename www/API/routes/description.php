<?php
	#print "Description.php is here";
	$app->get('/description/:toolUID', function ($toolUID) use ($tool) { print_r($tool->getDescriptions($toolUID)); } );
?>