<?php

return array(
    "attributes" => array(
        "id" => "ID",
	"email_adress" => "Epostadress",
	"password" => "Lösenord",
	"password_confirmation" => "Upprepa lösenord",
	"name" => "Namn",
	"locale" => "Språk",
	"active" => "Aktiv",
	"user_level" => "Användarnivå",
        "remember_token" => "Spara token",
	"logins" => "Inloggningar",
	"created_at" => "Skapad den",
	"updated_at" => "Uppdaterad den",
	"deleted_at" => "Raderad den"
    ),
    "active" => array(
	"yes" => "Ja",
	"no" => "Nej"
    ),
    "user_level" => array(
        "authenticated_user" => array(
	    "name" => "Inloggad användare"
        ),
        "collaborator" => array(
	    "name" => "Medarbetare"
        ),
        "supervisor" => array(
	    "name" => "Övervakare"
        ),
        "administrator" => array(
	    "name" => "Admistratör"
        )
    )
);
