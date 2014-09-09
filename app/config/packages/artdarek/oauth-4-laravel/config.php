<?php

return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => $_ENV["OAUTH.FACEBOOK.clientID"],
            'client_secret' => $_ENV["OAUTH.FACEBOOK.secret"],
            'scope'         => array('email'),
        ),      
        'Google' => array(
            'client_id'     => $_ENV["OAUTH.GOOGLE.clientID"],
            'client_secret' => $_ENV["OAUTH.GOOGLE.secret"],
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ), 
        'Linkedin' => array(
            'client_id'     => $_ENV["OAUTH.LINKEDIN.clientID"],
            'client_secret' => $_ENV["OAUTH.LINKEDIN.secret"],
            'scope'         => array('r_emailaddress', 'r_basicprofile'),
        ),  
    )

);