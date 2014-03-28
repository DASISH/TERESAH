<?php

/////////////////////////////////////////////////////////////////////////////
//Main									   //
/////////////////////////////////////////////////////////////////////////////
$app->get('/', function () {

    display('statistics.php', array('statistics' => Statistics::all()));
});

/////////////////////////////////////////////////////////////////////////////
//Signout									   //
/////////////////////////////////////////////////////////////////////////////
$app->get('/signout/', function () use ($app) {
    session_destroy();
    $app->setEncryptedCookie('t23-p', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setEncryptedCookie('t23-u', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setEncryptedCookie('t23-i', false, "1 second", "/", COOKIE_DOMAIN);
    $app->setCookie('logged', false, "1 second", "/", COOKIE_DOMAIN);
    $app->redirect('/');
});
?>