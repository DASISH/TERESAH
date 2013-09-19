<?php
	if(!defined("DASISH")) { exit(); }
	foreach (glob("routes/*.php") as $filename)
	{
		if ($filename != "routes/index.php") {
			require_once $filename;
		}
	}
	$app->map('/:x+', function($x) {
		http_response_code(200);
	})->via('OPTIONS');
?>