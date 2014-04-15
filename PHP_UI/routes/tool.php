<?php

$app->get('/tool/:shortname', function ($shortname) { 
    display('tool.php', array(
                           'tool' => Tool::get($shortname, 
                                                array(
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
                                                  )
                                                )
                            )
            );
});

$app->get('/registry', function () use ($app){ 
    display('registry.php', array('tools' => Search::all($app->request->get())));
});

?>