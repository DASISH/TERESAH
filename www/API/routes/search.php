<?php

	$app->get('/search/general/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("search"));
		$filtered = $app->request->get(); 
		if((count($filtered) > 0) && isset($filtered["request"])) {
			foreach($filtered as $k => $v) {
				if($v == "false" && $k != "request") {
					$filtered[$k] = false;
				}
			}
			
			$data = Search::general($filtered);
			if(isset($data["Error"])) {
				$app->response()->status(400);
			} else {
				$data["status"] = "success";
				return jP($data); 
			}
		}
		return jP(array("status" => "error", "message" => "No input given")); 
		
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
		$filtered = $app->request->get();
		$data = Search::faceted($filtered);
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