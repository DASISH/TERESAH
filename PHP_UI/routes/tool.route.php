<?php

$app->get('/tool/:shortname', function ($shortname) {
    display('tool.tpl.php', array('tool' => Tool::get($shortname, array('all'=>true))));
});

$app->get('/registry', function () use ($app) {
    $tools = Search::all($app->request->get());
    $breadcrumb = array('/'=>'home', ''=>'browse');
    display('tool.list.tpl.php', array('title'=> 'Tools','tools' => $tools, 'breadcrumb'=>$breadcrumb));
});
?>