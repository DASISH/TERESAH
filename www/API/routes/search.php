<?php

	$app->get('/search/general', function () use ($search, $app) { 
		$data = $search->general($app->request->get()); 
		
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
		
	});

	$app->get('/search/all', function () use ($search, $app) { 
		$data = $search->all($app->request->get()); 
		
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
		
	});

	$app->post('/search/general', function () use ($search, $app) { 
		$data = $search->general($app->request->post()); 
		
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
		
	});
	
	$app->get('/search/facet/:field', function ($facet) use ($search, $app) { 
		$data = $search->fieldContent($facet, $app->request->get());
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
	$app->get('/search/faceted/', function () use ($search, $app) {
		$data = $search->faceted($app->request->get());
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
	$app->post('/search/faceted', function () use ($search, $app) {
	
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$input = array();
		}
		
		$data = $search->faceted($input);
		if(isset($data["Error"])) {
			return jP($data);
			//$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
	$app->get('/search/facetList/', function () use ($search) {
		$data = $search->getFacets();
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
?>