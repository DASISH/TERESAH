<?php

$app->get('/profile', function () { 
    if(isset($_SESSION['user'])) {
        display('profile.tpl.php', array('keys' => array()));        
    }
});
