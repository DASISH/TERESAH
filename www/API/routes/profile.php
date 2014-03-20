<?php

$app->post('/profile/', function () {

    if (!isset($_SESSION["user"]["id"])) {
        jP(array("status" => "error", "message" => "You need to be logged in to use this function"));
        exit();
    }

    User::update($obj.id, $obj.name, $obj.mail, $obj.password);
    exit;
});

?>