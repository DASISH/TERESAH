<?php
	$app->get('/pie/descriptions', function () use ($pie, $app) { 
		$app->response()->header('Content-Type', 'image/png');
		$pie->descriptions(); 
	});
	$app->get('/pie/test', function () use ($pie, $app) { 
		$app->response()->header('Content-Type', 'image/png');
		$pie->test(); 
	});
?>