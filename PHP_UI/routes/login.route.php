<?php

$app->get('/login', function () { 
    display('login.tpl.php', array());        
});

$app->get('/signup', function () { 
    display('signup.tpl.php', array());        
});