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
?>