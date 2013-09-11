<?php
	#print "Description.php is here";
	$app->get('/description/:toolUID', function ($toolUID) use ($tool) { jP($tool->getDescriptions($toolUID)); } );
?>