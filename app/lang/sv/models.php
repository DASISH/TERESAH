<?php

return array(
    "activity" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "target_type" => "Typ",
            "target_id" => "ID för mål",
            "action" => "Handling",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "metadata" => "Metadata",
            "ip_address" => "IP-adress",
            "user_agent" => "Webbläsare",
            "referer" => "Refererad från",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at")
        )
    ),

    "apikey" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "token" => "Åtkomst-token",
            "enabled" => "Aktiverad",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        )
    ),

    "data" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "data_source" => "Informationskälla",
            "data_source_id" => "ID för informationskälla",
            "tool" => "Verktyg",
            "tool_id" => "ID för verktyg",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "data_type" => "Datatyp",
            "data_type_id" => "ID för datatyp",
            "value" => "Värde",
            "slug" => Lang::get("shared.slug"),
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        )
    ),

    "datasource" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "name" => Lang::get("shared.name"),
            "slug" => Lang::get("shared.slug"),
            "description" => Lang::get("shared.description"),
            "homepage" => "Hemsida",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        )
    ),

    "datatype" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "label" => "Etikett",
            "slug" => Lang::get("shared.slug"),
            "description" => Lang::get("shared.description"),
            "rdf_mapping" => "RDF-mappning",
            "linkable" => "Länkbar",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        ),
        "linkable" => array(
            "yes" => "Ja",
            "no" => "Nej"
        ),
    ),

    "login" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "ip_address" => "IP-adress",
            "user_agent" => "Webbläsare",
            "referer" => "Refererad från",
            "via_remember" => "Via sparad token",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        )
    ),

    "tool" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "name" => Lang::get("shared.name"),
            "slug" => Lang::get("shared.slug"),
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        )
    ),

    "user" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "email_adress" => "Epostadress",
            "password" => "Lösenord",
            "password_confirmation" => "Upprepa lösenord",
            "name" => Lang::get("shared.name"),
            "locale" => "Språk",
            "active" => "Aktiv",
            "user_level" => "Användarnivå",
            "remember_token" => "Spara token",
            "logins" => "Inloggningar",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
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
    )
);
