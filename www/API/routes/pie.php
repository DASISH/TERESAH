<?php
	$app->get('/pie/descriptions/:mode', function ($mode) use ($pie, $app) { 
		$app->response()->header('Content-Type', 'image/png');
		$pie->descriptions($mode); 
	});
	$app->get('/pie/test', function () use ($pie, $app) { 
		$app->response()->header('Content-Type', 'image/png');
		$pie->test(); 
	});
?>