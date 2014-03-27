<?php

$app->get('/tool', function () { 
    display('tool_list.php', array('tools' => AdminTool::listAll()));
});

$app->get('/tool/:shortname', function ($shortname) { 
    display('forms/tool_edit.php', array('tool' => AdminTool::getTool($shortname)));
});

?>
