<?php
	#print "Description.php is here";
	$app->get('/faq', function () { 
		$app->contentType('application/json');
		include("faq.json");
		exit();
	} );
	
?>