<?php

/* List users */
$app->get('/user', function () { 
    display('user_list.php', array('users' => AdminUser::listAll()));
})->name('user_list');

/* Edit user */
$app->get('/user/edit/:user_uid', function ($user_uid) use ($app){ 

	$form_address = $app->urlFor('user_edit_post', array('user_uid' => $user_uid));

    display('forms/user_edit.php', array('user' => AdminUser::getUserByID($user_uid), 
										 'form_address' => $form_address,
										 'title' => 'Edit user'));
})->name('user_edit');

/* Edit user post */
$app->post('/user/edit/:user_uid', function ($user_uid) use ($app) {
    
	$result = AdminUser::update($user_uid,
								$app->request->post('name'),
								$app->request->post('mail'),
								$app->request->post('login'),
								$app->request->post('password'),
								$app->request->post('user_active') == 'on' ? 1 : 0,
								$app->request->post('user_admin') == 'on' ? 1 : 0);
	
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
$app->post('/user/add', function () use ($app) {

    $result = AdminUser::create($app->request->post('name'), 
							  	$app->request->post('mail'), 
								$app->request->post('login'), 
								$app->request->post('password'),
								$app->request->post('user_active') == 'on' ? 1 : 0,
								$app->request->post('user_admin') == 'on' ? 1 : 0);
	
	if(isset($result['success'])) {
		$app->flash('success', $result['success']);
		$app->redirect($app->urlFor('user_list'));
	}	
	else if(isset($result['error'])) {
		$app->flash('error', $result['error']);
	}
		
})->name('user_add_post');

?>
