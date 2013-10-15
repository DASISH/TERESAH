<?php
$app->get('/', function () use ($tool, $app){ 
    display('tool_list.php', array('tools' => $tool->listAll()));
});
?>
