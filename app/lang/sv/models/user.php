<?php

return array(
    "attributes" => array(
        "id" => "ID",
        #"email_address" => "Email address",
	"email_adress" => "E-postadress",
        #"password" => "Password",
	"password" => "Lösenord",
        #"password_confirmation" => "Password Confirmation",
	"password_confirmation" => "Upprepa lösenord",
        #"name" => "Name",
	"name" => "Namn",
        #"locale" => "Locale",
	"locale" => "Språk",
        #"active" => "Active",
	"active" => "Aktiv",
        #"user_level" => "User Level",
	"user_level" => "Användarnivå",
        "remember_token" => "Remember Token",
        #"logins" => "Logins",
	"logins" => "Inloggningar",
        #"created_at" => "Created at",
	"created_at" => "Skapad den",
        #"updated_at" => "Updated at",
	"updated_at" => "Uppdaterad den",
        #"deleted_at" => "Deleted at"
	"deleted_at" => "Raderad den"
    ),
    "active" => array(
        #"yes" => "Yes",
	"yes" => "Ja",
        #"no" => "No"
	"no" => "Nej"
    ),
    "user_level" => array(
        "authenticated_user" => array(
            #"name" => "Authenticated User"
	    "name" => "Autentiserad användare"
            # TODO: Add a translated "description" for the 
            # user.user_level.authenticated_user
        ),
        "collaborator" => array(
            #"name" => "Collaborator"
	    "name" => "Medarbetare"
            # TODO: Add a translated "description" for the 
            # user.user_level.collaborator
        ),
        "supervisor" => array(
            #"name" => "Supervisor"
	    "name" => "Handledare"
            # TODO: Add a translated "description" for the 
            # user.user_level.supervisor
        ),
        "administrator" => array(
            #"name" => "Administrator"
	    "name" => "Admistratör"
            # TODO: Add a translated "description" for the 
            # user.user_level.administrator
        )
    )
);
