<?php

	$app->get('/search/general', function () use ($search, $app) { 
		return jP($search->general($app->request->get())); 
	});
	
	$app->get('/search/facet/:field', function ($facet) use ($search, $app) { 
		return jP($search->fieldContent($facet, $app->request->get())); 
	});
	
	$app->get('/search/faceted/', function () use ($search, $app) { 
		return jP($search->faceted($app->request->get())); 
	});
?>