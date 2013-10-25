<?php

	$app->get('/search/general/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("search"));
		$data = Search::general($app->request->get()); 
		
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
		
	});

	$app->post('/search/general/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("search"));
		$data = Search::general($app->request->post()); 
		
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
		
	});
	
	$app->get('/search/faceted/', function () use ($require, $app) {
		$app->contentType('application/json');
		$require->req(array("search"));
		$data = Search::faceted($app->request->get());
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
	$app->post('/search/faceted/', function () use ($require, $app) {
		$app->contentType('application/json');
		$require->req(array("search"));
	
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$input = array();
		}
		
		$data = Search::faceted($input);
		if(isset($data["Error"])) {
			return jP($data);
			//$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
?>