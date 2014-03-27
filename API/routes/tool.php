<?php
	#print "Description.php is here";

	$app->get('/share/:toolUID', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool"));
		$tool = Tool::get($toolUID, $app->request->get());
		header('Content-Type: text/html');
		echo '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<title>DASISH-TERESAH | '.$tool["descriptions"]["title"].'</title>
				<meta property="og:title" content="'.$tool["descriptions"]["title"].'" />
				<meta property="og:site_name" content="DASISH-TERESAH" />
				<meta property="og:description" content="'.$tool["descriptions"]["description"][0]["text"].'" />
                                <meta http-equiv="refresh" content="1; url=http://'.$_SERVER['HTTP_HOST'].'/#/tool/'.$tool["identifier"]["shortname"].'" />			
</head>
			<body>
				'.nl2br($tool["descriptions"]["description"][0]["text"]).'
			</body>
		</html>';
		exit();
	} );

	$app->get('/tool/:toolUID', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool"));
		return jP(Tool::get($toolUID, $app->request->get())); 
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
		return jP(array("comments" => Comment::get($toolUID))); 
	} );
	
	$app->get('/tool/:toolUID/forum', function ($toolUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("comment"));
		return jP(array("comments" => Comment::get($toolUID, 2))); 
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
		
		$require->req(array("comment", "log"));
		return jP(Comment::insert($toolUID, $input)); 
	} );
	
	$app->post('/tool/:toolUID/forum', function ($toolUID) use ($require, $app) { 
	
		$require->req(array("comment", "log"));
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		return jP(Comment::insert($toolUID, $input, 2)); 
	} );

#############
#
#	NEW TOOL / POST FOR TOOL
#
#############
	$app->post('/tool/facet', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool", "helper", "log"));
		
		if(!isset($_SESSION["user"]["id"])) {
			return jP(array("status" => "error", "message" => "You need to be logged in to use this function"));
		}	
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		$item = array();
		foreach($input["facets"] as $i) {
			$item[] = Tool::linkFacets(array("element" => $i["element"], "facet" => $i["facet"], "tool" => $input["tool"]));
		}
		return jP($item);
	});
	$app->post('/tool/:toolId/edit', function ($toolId) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("helper", "description", "log"));
		
		if(!isset($_SESSION["user"]["id"])) {
			return jP(array("status" => "error" , "message" => "You need to be logged in to use this function"));
		}	
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		$item = Description::insert($toolId, $input);
		return jP($item);
	});
	
	$app->post('/tool/', function () use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("tool", "log"));
		
		if(!isset($_SESSION["user"]["id"])) {
			return jP(array("status" => "error", "message" => "You need to be logged in to use this function"));
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
			return jP($item);
		} else {
			$item["description"] = Description::insert($item["uid"], $input);
			if(isset($item["description"]["Error"])) {
				Tool::delete($item["uid"]);
				return jP(array($item, $input));
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
				return jP(array($item, $input, $facets));
			}
		}
	} );
?>