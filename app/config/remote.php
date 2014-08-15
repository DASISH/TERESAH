<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Remote Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default connection that will be used for SSH
    | operations. This name should correspond to a connection name below
    | in the server list. Each connection will be manually accessible.
    |
    */

    "default" => "production",

    /*
    |--------------------------------------------------------------------------
    | Remote Server Connections
    |--------------------------------------------------------------------------
    |
    | These are the servers that will be accessible via the SSH task runner
    | facilities of Laravel. This feature radically simplifies executing
    | tasks on your servers, such as deploying out these applications.
    |
    */

    "connections" => array(
        "production" => array(
            "host"      => $_ENV["CONNECTIONS.production.host"],
            "username"  => $_ENV["CONNECTIONS.production.username"],
            "password"  => $_ENV["CONNECTIONS.production.password"],
            "key"       => $_ENV["CONNECTIONS.production.key"],
            "keyphrase" => $_ENV["CONNECTIONS.production.keyphrase"],
            "root"      => $_ENV["CONNECTIONS.production.root"],
        ),
        "staging" => array(
            "host"      => $_ENV["CONNECTIONS.staging.host"],
            "username"  => $_ENV["CONNECTIONS.staging.username"],
            "password"  => $_ENV["CONNECTIONS.staging.password"],
            "key"       => $_ENV["CONNECTIONS.staging.key"],
            "keyphrase" => $_ENV["CONNECTIONS.staging.keyphrase"],
            "root"      => $_ENV["CONNECTIONS.staging.root"],
        ),        
    ), 

    /*
    |--------------------------------------------------------------------------
    | Remote Server Groups
    |--------------------------------------------------------------------------
    |
    | Here you may list connections under a single group name, which allows
    | you to easily access all of the servers at once using a short name
    | that is extremely easy to remember, such as "web" or "database".
    |
    */

    "groups" => array(
        "web" => array("production")
    ),
);
