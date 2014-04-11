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
?>