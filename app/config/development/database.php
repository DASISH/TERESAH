<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    "default" => "mysql",

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    "connections" => array(
        "mysql" => array(
            "driver"    => "mysql", 
            "host"      => "localhost", 
            "database"  => $_ENV["DATABASE_NAME"], 
            "username"  => $_ENV["DATABASE_USERNAME"], 
            "password"  => $_ENV["DATABASE_PASSWORD"], 
            "charset"   => "utf8", 
            "collation" => "utf8_unicode_ci", 
            "prefix"    => "", 
        ),
    ),
);
