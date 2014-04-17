<?php

$app->get('/login', function () use ($app) {
    if (!isset($_SESSION['user'])) {
        display('login.tpl.php', array());
    } else {
        $app->redirect('/profile');
    }
});

$app->post('/login', function () use ($app) {

    global $DB;

    if (count($app->request->post()) > 0) {
        $input = $app->request->post();
    } elseif (count($app->request()->getBody()) > 0) {
        $input = $app->request()->getBody();
    } else {
        $app->response()->status(400);
    }
  
    if (isset($input["user"]) && isset($input["password"]) && !empty($input['user']) && !empty($input['password'])) {

        $data = User::login($input);
        
        if($data["signin"] == true) {
            $d = $data["data"];
            $app->setEncryptedCookie('t23-p', hash("sha256", $input["password"]), "2 days");
            $app->setEncryptedCookie('t23-u',$input["user"], "2 days");
            $app->setEncryptedCookie('t23-i',$d["UID"], "2 days");
            $app->setCookie('logged',$d["Name"], "20 minutes", null,  COOKIE_DOMAIN);

            $_SESSION["user"] = array("id" => $d["UID"], "name" => $d["Name"], "mail" => $d["Mail"], "login" => $d["Login"], "level" => $d["Level"]);
            $app->redirect('/');
        } else {
            display('login.tpl.php', array('alert' => array('status' => 'danger', 'message' => 'Failed to log in'), 'fields' => $input));
        }
        
    } else {
        display('login.tpl.php', array('alert' => array('status' => 'danger', 'message' => 'Username and password needed'), 'fields' => $input));
    }
})->name('login');

$app->get('/signup', function () use ($app) {
    if (!isset($_SESSION['user'])) {
        display('signup.tpl.php', array());
    } else {
        $app->redirect('/profile');
    }
});

$app->post('/signup', function () use ($app) {

    global $DB;

    if (count($app->request->post()) > 0) {
        $post = $app->request->post();
    } elseif (count($app->request()->getBody()) > 0) {
        $post = $app->request()->getBody();
    } else {
        $app->response()->status(400);
    }
    
    $data = User::signup($post);
    if($data['status'] == 'success') {
        display('signup.tpl.php', array('alert' => array('status' => 'success', 'message' => $data['message'])));
    } else {
        display('signup.tpl.php', array('alert' => array('status' => 'danger', 'message' => $data['message']), 'fields' => $post));
    }
});

$app->get('/logout', function () use ($app) {
    session_destroy();
    $_SESSION['user'] = null;
    $app->setEncryptedCookie('t23-p', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setEncryptedCookie('t23-u', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setEncryptedCookie('t23-i', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setCookie('logged', false, "1 second", "/", COOKIE_DOMAIN);

    $app->redirect('/');
});
