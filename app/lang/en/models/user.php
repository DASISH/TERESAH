<?php

return array(
    "attributes" => array(
        "id" => "ID",
        "email_address" => "Email address",
        "password" => "Password",
        "password_confirmation" => "Password Confirmation",
        "name" => "Name",
        "locale" => "Locale",
        "active" => "Active",
        "user_level" => "User Level",
        "remember_token" => "Remember Token",
        "logins" => "Logins",
        "created_at" => "Created at",
        "updated_at" => "Updated at",
        "deleted_at" => "Deleted at"
    ),
    "active" => array(
        "yes" => "Yes",
        "no" => "No"
    ),
    "user_level" => array(
        "authenticated_user" => array(
            "name" => "Authenticated User"
            # TODO: Add a translated "description" for the 
            # user.user_level.authenticated_user
        ),
        "collaborator" => array(
            "name" => "Collaborator"
            # TODO: Add a translated "description" for the 
            # user.user_level.collaborator
        ),
        "supervisor" => array(
            "name" => "Supervisor"
            # TODO: Add a translated "description" for the 
            # user.user_level.supervisor
        ),
        "administrator" => array(
            "name" => "Administrator"
            # TODO: Add a translated "description" for the 
            # user.user_level.administrator
        )
    )
);
