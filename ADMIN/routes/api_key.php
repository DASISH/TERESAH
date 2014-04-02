<?php 

$app->get('/api_keys', function() use ($app) {

    $result = API::Get();
    
    $all = $result['data'];

    foreach ($all as &$key) {
        $user = AdminUser::getUserByID($key["user_uid"]);
        $key["user_name"] = $user["name"];
    }

    display('forms/api_keys.php', array('keys' => $all, 'title' => 'API Keys'));
})->name('api_keys');

$app->post('/api_keys', function() use ($app) {
    
    foreach ($app->request->params() as $key => $value) {
        $id = strtok($key, 'key_');
        API::Confirm($id);
    }
    
})->name('api_keys_post');

?>