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

    if (isset($input["user"]) && isset($input["password"])) {

        $pw = hash('sha256', $input["password"]);
        try {
            $req = $DB->prepare("SELECT user_uid as id, name, mail, login, user_level as level FROM user WHERE (login = ? OR mail = ?) AND password = ?");
            $req->execute(array($input["user"], $input["user"], $pw));
        } catch (Exception $e) {
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1) {

            $d = $req->fetch(PDO::FETCH_ASSOC);
            $app->setEncryptedCookie('t23-p', hash("sha256", $input["password"]), "2 days");
            $app->setEncryptedCookie('t23-u', $input["user"], "2 days");
            $app->setEncryptedCookie('t23-i', $d["id"], "2 days");
            $app->setCookie('logged', $d["name"], "20 minutes", null, COOKIE_DOMAIN);

            $_SESSION["user"] = $d;

            $app->redirect('/');
        } else {
            $app->flash('error', "Failed to login");
        }
    } else {
        $app->response()->status(401);
        $app->flash('error', "Username/password needed");
    }
});

$app->get('/signup', function () use ($app) {
    if (!isset($_SESSION['user'])) {
        display('signup.tpl.php', array());
    } else {
        $app->redirect('/profile');
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
