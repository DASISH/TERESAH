<?php
	
	$app->get('/facet/:facet/:facetID', function ($facet, $facetID) use ($require, $app) {
		$app->contentType('application/json');
		$require->req(array("facet", "search"));
		$facets = $app->request->get();
		$facets["facets"][$facet]["request"][] = $facetID;
		$data = Search::faceted($facets);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			$data["facet"] = Facets::get($facet, $facetID);
			$data["facet"]["facet"] = Helper::facet($facet);
			unset($data["parameters"]["url"],$data["parameters"]["facets"]);
			return jP($data); 
		}
	});	
	
	$app->get('/facet/:facet/', function ($facet) use ($require, $app) {
		$app->contentType('application/json');
		
		$require->req(array("facet", "search", "helper"));
		
		$options = $app->request->get();
		$data = Search::fieldContent($facet, $options);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			$data["facet"] = Facets::information($facet);
			return jP($data); 
		}
	});	
	
	$app->options('/facet/:facet/', function ($facet) use ($require, $app) {
		$app->contentType('application/json');
		
		$require->req(array("facet"));
		
		$data = Facets::insert($facet);
		return jP($data); 
		
	});	
	
	
	$app->post('/facet/:facet/', function ($facet) use ($require, $app) {
		$app->contentType('application/json');
		
		if(!isset($_SESSION["user"]["id"])) {
			jP(array("status" => "error" , "message" => "You need to be logged in to use this function"));
			exit();
		}	
		
		$require->req(array("facet", "helper", "log"));
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			$app->response()->status(400);
		}
		
		#Then Process
		$data = Facets::insert($facet, $input);
		return jP($data); 
	});	
	
	$app->get('/facet/', function () use ($require, $app) {
		$app->contentType('application/json');
		$require->req(array("facet"));
		$data = Facets::information();
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	$app->options('/facet/', function () use ($require, $app) {
		$app->contentType('application/json');
		$require->req(array("facet"));
		$data = Facets::information(false,true);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
?>