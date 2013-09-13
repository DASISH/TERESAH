<?php

	$app->get('/search/general', function () use ($search, $app) { 
		return jP($search->general($app->request->get())); 
	});
?>