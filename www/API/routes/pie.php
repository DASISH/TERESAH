<?php
	$app->get('/pie/descriptions/:mode', function ($mode) use ($require, $app) { 
		$app->response()->header('Content-Type', 'image/png');
		$require->req("graphic");
		Graphic::descriptions($mode); 
	});
?>