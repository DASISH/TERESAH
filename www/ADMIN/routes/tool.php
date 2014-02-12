<?php

$app->get('/tool', function () use ($tool){ 
    display('tool_list.php', array('tools' => AdminTool::listAll()));
});

$app->get('/tool/:shortname', function ($shortname) use ($tool){ 
    display('forms/tool_edit.php', array('tool' => AdminTool::getTool($shortname)));
});

?>
