<?php
$app->get('/', function () use ($statistics){ 
    display('statistics.php', array('statistics' => $statistics->all()));
});

$app->get('/tool', function () use ($tool){ 
    display('tool_list.php', array('tools' => $tool->listAll()));
});

$app->get('/tool/:shortname', function ($shortname) use ($tool){ 
    display('forms/tool.php', array('tool' => $tool->getTool($shortname)));
});

$app->get('/user', function () use ($user){ 
    display('user_list.php', array('users' => $user->listAll()));
})->name('user_list');

$app->get('/user/:user_uid', function ($user_uid) use ($user, $app){ 
    display('forms/edit_user.php', array('user' => $user->getUserByID($user_uid), 'app' => $app));
})->name('user_edit');

$app->post('/user/:user_uid', function ($user_uid) use ($user, $app) {
    $user->update(array('user_uid' => $user_uid,
						'name' => $app->request->post('name'),
						'mail' => $app->request->post('mail'),
						'login' => $app->request->post('login'),
						'password' => $app->request->post('password')));
	$app->flash('info', 'Saved');
	$app->flashKeep();
	$app->redirect($app->urlFor('user_list'));
})->name('user_edit_post');


?>