<?php

$app->post('/profile/', function () use ($require, $app){

    if (!isset($_SESSION["user"]["id"])){
        return jP(array("status" => "error", "message" => "You need to be logged in to use this function"));
    }

    $require->req("user");

    if (count($app->request->post()) > 0){
        $input = $app->request->post();
    }
    elseif (count($app->request()->getBody()) > 0){
        $input = $app->request()->getBody();
    }
    else{
        $app->response()->status(400);
    }

    $post = array();
    if (isset($input["name"])){
        $post["name"] = $input["name"];
    }
    if (isset($input["mail"])){
        $post["mail"] = $input["mail"];
    }
    if (isset($input["login"])){
        $post["login"] = $input["login"];
    }
    if (isset($input["password"])){
        $post["password"] = $input["password"];
    }

    return jP(User::update($_SESSION["user"]["id"], $post));
});

$app->post('/api_key_application/', function () use ($require, $app){

    if (!isset($_SESSION["user"]["id"])){
        return jP(array("status" => "error", "message" => "You need to be logged in to use this function"));
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
    
    
    if(!isset($input["domain"])){
        return jP(array("status" => "error", "message" => "Domain is mandatory"));
    }
        
    $require->req("api");
        
    $result = API::Apply($input["domain"], $_SESSION["user"]["id"]);
    
    if($result['status'] == 'success')
    {
        $_SESSION['user']['keys'][] = array("domain" => $input["domain"], "public_key" => null, "private_key" => null);
    }
    
    return jP($result);
    
});
?>