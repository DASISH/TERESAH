<?php	
	$app->get('/topic/:topicUID', function ($topicUID) use ($comment, $app) { 
		$app->contentType('application/json');
		jP(array("topic" => $comment->topic($topicUID))); 
	} );
	
	
	$app->post('/topic/:toolUID/:topicUID', function ($toolUID, $topicUID) use ($comment, $app) { 
		$app->contentType('application/json');
		
		if(count($app->request->post()) > 0) {
			$input = $app->request->post();
		} elseif(count($app->request()->getBody()) > 0) {
			$input = $app->request()->getBody();
		} else {
			return $app->response()->status(400);
		}
		
		jP(array("topic" => $comment->reply($toolUID, $topicUID, $input))); 
	} );
?>