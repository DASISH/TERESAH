<?php

$app->get('/profile', function () use ($app) { 
    if(isset($_SESSION['user'])) {
        
        $keys = User::getAPIKeysForID($_SESSION['user']['id']);
        display('profile.tpl.php', array('keys' => $keys));        
    }
    else {
        $app->redirect('/login');
    }
});

$app->post('/profile', function () use ($app) {
   
    if (!isset($_SESSION["user"]["id"])){
        $app->redirect('/login');
    }

    if (count($app->request->post()) > 0){
        $input = $app->request->post();
    }
    elseif (count($app->request()->getBody()) > 0){
        $input = $app->request()->getBody();
    }
    else{
        $app->response()->status(400);
    }
    
    if ($input['password1'] != $input['password2']) {
        display('profile.tpl.php', array('alert' => array('status' => 'danger',  'form' => 'profile', 'message' => "Passwords doesn't match"), 'keys' => User::getAPIKeysForID($_SESSION['user']['id'])));
    }
    
    $post = array();
    if (isset($input["name"]) && !empty($input['name'])){
        $post["name"] = $input["name"];
    }
    if (isset($input["mail"]) && !empty($input['mail'])){
        $post["mail"] = $input["mail"];
    }
    if (isset($input["login"]) && !empty($input['login'])){
        $post["login"] = $input["login"];
    }
    if (isset($input["password1"]) && !empty($input['password1'])){
        $post["password"] = $input["password1"];
    }
     
    $data = User::update($_SESSION['user']['id'], $post);
    if ($data['status'] == 'success') {  
        if (isset($input["name"]) && !empty($input['name'])){
            $_SESSION['user']['name'] = $input['name'];
        }
        if (isset($input["mail"]) && !empty($input['mail'])){
            $_SESSION['user']['mail'] = $input['mail'];
        }
        if (isset($input["login"]) && !empty($input['login'])){
            $_SESSION['user']['login'] = $input['login'];
        }

        display('profile.tpl.php', array('alert' => array('status' => 'success',  'form' => 'profile', 'message' => $data['message']), 'keys' => User::getAPIKeysForID($_SESSION['user']['id'])));
    } else {
        display('profile.tpl.php', array('alert' => array('status' => 'danger',  'form' => 'profile', 'message' => $data['message']), 'fields' => $post, 'keys' => User::getAPIKeysForID($_SESSION['user']['id'])));
    }
});
