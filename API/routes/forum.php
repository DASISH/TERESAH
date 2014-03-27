<?php	
	$app->get('/topic/:topicUID', function ($topicUID) use ($require, $app) { 
		$app->contentType('application/json');
		$require->req(array("comment"));
		jP(array("topic" => Comment::topic($topicUID))); 
	} );
	
	
	$app->post('/topic/:toolUID/:topicUID', function ($toolUID, $topicUID) use ($require, $app) { 
		$app->contentType('application/json');
		
		$require->req(array("comment", "log"));
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		jP(array("topic" => Comment::reply($toolUID, $topicUID, $input))); 
	} );
?>