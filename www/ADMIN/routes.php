<?php

/////////////////////////////////////////////////////////////////////////////
//								Main									   //
/////////////////////////////////////////////////////////////////////////////
$app->get('/', function () use ($statistics, $app){ 
    display('statistics.php', array('statistics' => $statistics->all()));
});

/////////////////////////////////////////////////////////////////////////////
//								Tool									   //
/////////////////////////////////////////////////////////////////////////////

$app->get('/tool', function () use ($tool){ 
    display('tool_list.php', array('tools' => $tool->listAll()));
});

$app->get('/tool/:shortname', function ($shortname) use ($tool){ 
    display('forms/tool.php', array('tool' => $tool->getTool($shortname)));
});

/////////////////////////////////////////////////////////////////////////////
//								User									   //
/////////////////////////////////////////////////////////////////////////////

/* List users */
$app->get('/user', function () use ($user){ 
    display('user_list.php', array('users' => $user->listAll()));
})->name('user_list');

/* Edit user */
$app->get('/user/edit/:user_uid', function ($user_uid) use ($user, $app){ 

	$form_address = $app->urlFor('user_edit_post', array('user_uid' => $user_uid));

    display('forms/user_edit.php', array('user' => $user->getUserByID($user_uid), 
										 'form_address' => $form_address,
										 'title' => 'Edit user'));
})->name('user_edit');

/* Edit user post */
$app->post('/user/edit/:user_uid', function ($user_uid) use ($user, $app) {
    
	$app->flash('info', "post('/user/:user_uid'");
	$result = $user->update(array('user_uid' => $user_uid,
						'name' => $app->request->post('name'),
						'mail' => $app->request->post('mail'),
						'login' => $app->request->post('login'),
						'password' => $app->request->post('password')));
	
	if(isset($result['success'])) {
		$app->flash('success', $result['success']);
		$app->redirect($app->urlFor('user_list'));
	}	
	else if(isset($result['error'])) {
		$app->flash('error', $result['error']);
	}
		
})->name('user_edit_post');

/* Add user */
$app->get('/user/add', function () use ($app){ 
	
	$form_address = $app->urlFor('user_add_post');

	display('forms/user_edit.php', array('user' => array(), 
										 'form_address' => $form_address, 
										 'title' => 'Add user'));
})->name('user_add');

/* Add user post */
$app->post('/user/add', function () use ($user, $app) {

	$app->flash('info', "post('/user/add'");

    $result = $user->create($app->request->post('name'), 
							$app->request->post('mail'), 
							$app->request->post('login'), 
							$app->request->post('password'));
	
	if(isset($result['success'])) {
		$app->flash('success', $result['success']);
		$app->redirect($app->urlFor('user_list'));
	}	
	else if(isset($result['error'])) {
		$app->flash('error', $result['error']);
	}
		
})->name('user_add_post');


?>