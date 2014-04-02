<?php

$app->get('/user/verify/:user_uid/:token', function ($user_uid, $token) use ($require, $app){
    $require->req("user");
    $validation = User::verifyEmailToken($user_uid, $token);
    
    if($validation['status'] != 'verified'){
        return jP($validation);
    }
    else{
        $app->redirect('/login');
    }
});

?>