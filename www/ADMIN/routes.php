<?php

/////////////////////////////////////////////////////////////////////////////
//								Main									   //
/////////////////////////////////////////////////////////////////////////////
$app->get('/', function (){ 
    display('statistics.php', array('statistics' => Statistics::all()));
});

/////////////////////////////////////////////////////////////////////////////
//								Tool									   //
/////////////////////////////////////////////////////////////////////////////

$app->get('/tool', function () use ($tool){ 
    display('tool_list.php', array('tools' => $tool->listAll()));
});

$app->get('/tool/:shortname', function ($shortname) use ($tool){ 
    display('forms/tool_edit.php', array('tool' => $tool->getTool($shortname)));
});

/////////////////////////////////////////////////////////////////////////////
//								User									   //
/////////////////////////////////////////////////////////////////////////////

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

/////////////////////////////////////////////////////////////////////////////
//								Log										   //
/////////////////////////////////////////////////////////////////////////////

/* List logs */
$app->get('/log', function () { 
    display('log_list.php', array('logs' => Log::listAll()));
})->name('log_list');

/////////////////////////////////////////////////////////////////////////////
//								Facets									   //
/////////////////////////////////////////////////////////////////////////////

/* List platforms */
$app->get('/platform', function () { 

	$fields = array('Name' => 'name');

    display('facets_list.php', array('facet' => 'platform', 'title' => 'Platforms', 'facet_uid' => 'platform_uid', 'fields' => $fields, 'items' => AdminFacets::getAllPlatforms()));
})->name('platform_list');

/* List keywords */
$app->get('/keyword', function () { 

	$fields = array('Keyword' => 'keyword', 'Source URI' => 'source_uri', 'Source taxonomy' => 'source_taxonomy');

    display('facets_list.php', array('facet' => 'keyword', 'title' => 'Keywords', 'facet_uid' => 'keyword_uid', 'fields' => $fields, 'items' => AdminFacets::getAllKeywords()));
})->name('keyword_list');

/* List developers */
$app->get('/developer', function () { 

	$fields = array('Name' => 'name', 'Contact' => 'contact', 'Type' => 'type');

    display('facets_list.php', array('facet' => 'developer', 'title' => 'Developers', 'facet_uid' => 'developer_uid', 'fields' => $fields, 'items' => AdminFacets::getAllDevelopers()));
})->name('developer_list');

/* List tool types */
$app->get('/tool-type', function () { 

	$fields = array('Tool type' => 'tool_type', 'Source URI' => 'source_uri');

    display('facets_list.php', array('facet' => 'tool-type', 'title' => 'Tool types', 'facet_uid' => 'tool_type_uid', 'fields' => $fields, 'items' => AdminFacets::GetAllToolTypes()));
})->name('tool_type_list');

/* List licenses */
$app->get('/license', function () { 

	$fields = array('Text' => 'text', 'Type' => 'type');

    display('facets_list.php', array('facet' => 'license', 'title' => 'Licenses', 'facet_uid' => 'licence_uid', 'fields' => $fields, 'items' => AdminFacets::getAllLicenses()));
})->name('license_list');

/* List licenses */
$app->get('/license-type', function () { 

	$fields = array('Type' => 'type');

    display('facets_list.php', array('facet' => 'license-type', 'title' => 'License types', 'facet_uid' => 'licence_type_uid', 'fields' => $fields, 'items' => AdminFacets::getAllLicenseTypes()));
})->name('license_type_list');

/* Add platform */
$app->get('/platform/add', function () use ($app){ 
	
    $form_address = $app->urlFor('platform_add_post');

    display('forms/platform_edit.php', array('platform' => array(), 
                                                'form_address' => $form_address, 
                                                'title' => 'Add platform'));
})->name('platform_add');

/* Add platform post */
$app->post('/platform/add', function () use ($app) {

    $result = AdminFacets::CreatePlatform($app->request->post('name'));
	
    if(isset($result['success'])) {
            $app->flash('success', $result['success']);
            $app->redirect($app->urlFor('platform_list'));
    }	
    else if(isset($result['error'])) {
            $app->flash('error', $result['error']);
    }
		
})->name('platform_add_post');

/* Edit platform */
$app->get('/platform/edit/:platform_uid', function ($platform_uid) use ($app){ 

    $form_address = $app->urlFor('platform_edit_post', array('platform_uid' => $platform_uid));

    display('forms/platform_edit.php', array('platform' => AdminFacets::GetPlatformByID($platform_uid), 
                                             'form_address' => $form_address,
                                             'title' => 'Edit platform'));
})->name('platform_edit');

/* Edit platform post */
$app->post('/platform/edit/:platform_uid', function ($platform_uid) use ($app) {
    
    $result = AdminFacets::UpdatePlatform($platform_uid, $app->request->post('name'));

    if(isset($result['success'])) {
        $app->flash('success', $result['success']);
        $app->redirect($app->urlFor('platform_list'));
    }	
    else if(isset($result['error'])) {
        $app->flash('error', $result['error']);
    }
		
})->name('platform_edit_post');

?>