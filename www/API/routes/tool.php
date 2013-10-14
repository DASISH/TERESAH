<?php
	#print "Description.php is here";
	$app->get('/tool/:toolUID', function ($toolUID) use ($tool, $app) { 
		$app->contentType('application/json');
		jP($tool->getTool($toolUID, $app->request->get())); 
	} );
	
	$app->get('/tool/:toolUID/comments', function ($toolUID) use ($comment, $app) { 
		$app->contentType('application/json');
		jP(array("comments" => $comment->get($toolUID))); 
	} );
	
	$app->get('/tool/:toolUID/forum', function ($toolUID) use ($comment, $app) { 
		$app->contentType('application/json');
		jP(array("comments" => $comment->get($toolUID, 2))); 
	} );
	
	$app->post('/tool/:toolUID/comments', function ($toolUID) use ($comment, $app) { 
		$app->contentType('application/json');
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		jP($comment->insert($toolUID, $input)); 
	} );
	
	$app->post('/tool/:toolUID/forum', function ($toolUID) use ($comment, $app) { 
	
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		jP($comment->insert($toolUID, $input, 2)); 
	} );
	
	$app->post('/tool/', function () use ($tool, $app) { 
		$app->contentType('application/json');
		
		if(!isset($_SESSION["user"]["id"])) {
			jP(array("Error" => "You need to be logged in to use this function"));
			exit();
		}
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		$item = $tool->insertTool($input);
		if(isset($item["Error"])) {
			jP($item);
			exit();
		} else {
			$item["description"] = $tool->insertDescription($item["uid"], $input);
			if(isset($item["description"]["Error"])) {
				$tool->delete($item["uid"]);
				jP(array($item, $input));
				exit();
			}
			else {
				$facets = array();
				//{"facets":{"ApplicationType":{"request":["webApplication"]},"Platform":{"request":["6"]}}
				foreach($input["facets"] as $key => &$val) {
				
					if($key != "Licence") {
						foreach($val["request"] as $k2 => &$facetId) {
							$facetData = array("facet" => $key, "element" => $facetId, "tool" => $item["uid"]);
							$facet = $tool->linkFacets($facetData);
							
							if(isset($facet["Error"])) {
								$facets[] = $facet;
								$error = true;
								break;
							}
							
						}
						if(isset($error)) {
							break;
						}
					}
				}
				jP(array($item, $input, $facets));
			}
		}
	} );
?>