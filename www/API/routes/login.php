<?php
$app->map('/login/', function () use ($app, $user) {
	// Don't forget to set the correct attributes in your form (name="user" + name="password")
	
	if(count($app->request->post()) > 0) {
		$input = (object) $app->request->post();
	} elseif(count($app->request()->getBody()) > 0) {
		$input = (object) $app->request()->getBody();
	} else {
		$app->response()->status(400);
	}
	if(isset($input->user) && isset($input->password))
	{
		$data = $user->login($input);
		return jP($data);
		if($data["signin"] == true) {
			$app->setEncryptedCookie('my_cookie',$input->password);
			return jP($data["data"]);
		}
		
	} 
	else
	{
		$app->redirect('login');
	}
})->via('POST')->name('login');

$authAdmin = function  ( $role = 'member') {

    return function () use ( $role ) {

        $app = Slim::getInstance('my_cookie');

        // Check for password in the cookie
        if($app->getEncryptedCookie('my_cookie',false) != 'YOUR_PASSWORD'){

            $app->redirect('/login');
        }
    };
};
?>