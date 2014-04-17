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
