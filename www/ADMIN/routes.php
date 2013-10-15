<?php
$app->get('/', function () use ($statistics){ 
    display('statistics.php', array('statistics' => $statistics->all()));
});
$app->get('/tool', function () use ($tool){ 
    display('tool_list.php', array('tools' => $tool->listAll()));
});

$app->get('/user', function () use ($user){ 
    display('user_list.php', array('users' => $user->listAll()));
});
?>