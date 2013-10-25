<?php
	#print "Description.php is here";
	$app->get('/tool/:toolUID', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool"));
		jP(Tool::get($toolUID, $app->request->get())); 
	} );
	
	$app->get('/tool/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("search"));
		$data = Search::all($app->request->get()); 
			
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			return jP($data); 
		}
	});
	
################
#
#	COMMENTS AND FORUM PART
#
################

	$app->get('/tool/:toolUID/comments', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("comment"));
		jP(array("comments" => Comment::get($toolUID))); 
	} );
	
	$app->get('/tool/:toolUID/forum', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("comment"));
		jP(array("comments" => Comment::get($toolUID, 2))); 
	} );
	
	$app->post('/tool/:toolUID/comments', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		$require->req(array("comment"));
		jP(Comment::insert($toolUID, $input)); 
	} );
	
	$app->post('/tool/:toolUID/forum', function ($toolUID) use ($require, $app) { 
	
		$require->req(array("comment"));
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		jP(Comment::insert($toolUID, $input, 2)); 
	} );

#############
#
#	NEW TOOL / POST FOR TOOL
#
#############
	$app->post('/tool/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool"));
		
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
		
		$item = Tool::insert($input);
		if(isset($item["Error"])) {
			jP($item);
			exit();
		} else {
			$item["description"] = Description::insert($item["uid"], $input);
			if(isset($item["description"]["Error"])) {
				Tool::delete($item["uid"]);
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
							$facet = Tool::linkFacets($facetData);
							
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