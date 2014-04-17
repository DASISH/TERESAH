<?php

$app->get('/tool/:shortname', function ($shortname) {
    display('tool.tpl.php', array(
        'tool' => Tool::get($shortname, array(
            "similar",
            "keyword",
            "type",
            "platform",
            "developer",
            "projects",
            "suite",
            "standards",
            "video",
            "features",
            "publications",
            "licence",
            "applicationType"
        ))
    ));
});

$app->get('/registry', function () use ($app) {
    display('registry.tpl.php', array('tools' => Search::all($app->request->get())));
});
?>