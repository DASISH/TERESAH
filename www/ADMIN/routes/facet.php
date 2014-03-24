<?php

/* List platforms */
$app->get('/platform', function () { 

	$fields = array('Name' => 'name');

    display('facets_list.php', array('facet' => 'platform', 'title' => 'Platforms', 'facet_uid' => 'platform_uid', 'fields' => $fields, 'items' => AdminFacets::getAllPlatforms()));
})->name('platform_list');

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

/* List keywords */
$app->get('/keyword', function () { 

	$fields = array('Keyword' => 'keyword', 'Source URI' => 'source_uri', 'Source taxonomy' => 'source_taxonomy');

    display('facets_list.php', array('facet' => 'keyword', 'title' => 'Keywords', 'facet_uid' => 'keyword_uid', 'fields' => $fields, 'items' => AdminFacets::getAllKeywords()));
})->name('keyword_list');

/* Add keyword */
$app->get('/keyword/add', function () use ($app){ 
	
    
    $test = AdminFacets::information();
    
    
    $form_address = $app->urlFor('keyword_add_post');

    display('forms/keyword_edit.php', array('keyword' => array(), 
                                                'form_address' => $form_address, 
                                                'title' => 'Add keyword'));
})->name('keyword_add');

/* Add keyword post */
$app->post('/keyword/add', function () use ($app) {

    $result = AdminFacets::CreateKeyword($app->request->post('keyword'),
                                         $app->request->post('source_uri'),
                                         $app->request->post('source_taxonomy'));
	
    if(isset($result['success'])) {
            $app->flash('success', $result['success']);
            $app->redirect($app->urlFor('keyword_list'));
    }	
    else if(isset($result['error'])) {
            $app->flash('error', $result['error']);
    }
		
})->name('keyword_add_post');

/* Edit keyword */
$app->get('/keyword/edit/:keyword_uid', function ($keyword_uid) use ($app){ 

    $form_address = $app->urlFor('keyword_edit_post', array('keyword_uid' => $keyword_uid));

    display('forms/keyword_edit.php', array('keyword' => AdminFacets::GetKeywordByID($keyword_uid), 
                                             'form_address' => $form_address,
                                             'title' => 'Edit keyword'));
})->name('keyword_edit');

/* Edit keyword post */
$app->post('/keyword/edit/:keyword_uid', function ($keyword_uid) use ($app) {
    
    $result = AdminFacets::UpdateKeyword($keyword_uid, 
                                         $app->request->post('keyword'),
                                         $app->request->post('source_uri'),
                                         $app->request->post('source_taxonomy'));

    if(isset($result['success'])) {
        $app->flash('success', $result['success']);
        $app->redirect($app->urlFor('keyword_list'));
    }	
    else if(isset($result['error'])) {
        $app->flash('error', $result['error']);
    }
		
})->name('keyword_edit_post');

/* List developers */
$app->get('/developer', function () { 

	$fields = array('Name' => 'name', 'Contact' => 'contact', 'Type' => 'type');

    display('facets_list.php', array('facet' => 'developer', 'title' => 'Developers', 'facet_uid' => 'developer_uid', 'fields' => $fields, 'items' => AdminFacets::getAllDevelopers()));
})->name('developer_list');

/* Add developer */
$app->get('/developer/add', function () use ($app){ 
	
    $form_address = $app->urlFor('developer_add_post');

    display('forms/developer_edit.php', array('developer' => array(), 
                                                'form_address' => $form_address, 
                                                'title' => 'Add developer'));
})->name('developer_add');

/* Add developer post */
$app->post('/developer/add', function () use ($app) {

    $result = AdminFacets::CreateDeveloper($app->request->post('name'),
                                         $app->request->post('contact'),
                                         $app->request->post('type'));
	
    if(isset($result['success'])) {
            $app->flash('success', $result['success']);
            $app->redirect($app->urlFor('developer_list'));
    }	
    else if(isset($result['error'])) {
            $app->flash('error', $result['error']);
    }
		
})->name('developer_add_post');

/* Edit developer */
$app->get('/developer/edit/:developer_uid', function ($developer_uid) use ($app){ 

    $form_address = $app->urlFor('developer_edit_post', array('developer_uid' => $developer_uid));

    display('forms/developer_edit.php', array('developer' => AdminFacets::GetDeveloperByID($developer_uid), 
                                             'form_address' => $form_address,
                                             'title' => 'Edit developer'));
})->name('developer_edit');

/* Edit developer post */
$app->post('/developer/edit/:developer_uid', function ($developer_uid) use ($app) {
    
    $result = AdminFacets::UpdateDeveloper($developer_uid, 
                                         $app->request->post('name'),
                                         $app->request->post('contact'),
                                         $app->request->post('type'));

    if(isset($result['success'])) {
        $app->flash('success', $result['success']);
        $app->redirect($app->urlFor('developer_list'));
    }	
    else if(isset($result['error'])) {
        $app->flash('error', $result['error']);
    }
		
})->name('developer_edit_post');

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



?>
