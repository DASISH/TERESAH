<?php

$app->get('/profile', function () use ($app) { 
    if(isset($_SESSION['user'])) {
        display('profile.tpl.php', array('keys' => array()));        
    }
    else {
        $app->redirect('/login');
    }
});
