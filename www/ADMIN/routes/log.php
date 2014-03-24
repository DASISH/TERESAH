<?php

/* List logs */
$app->get('/log', function () { 
    display('log_list.php', array('logs' => Log::listAll()));
})->name('log_list');

?>
