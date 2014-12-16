<?php

return array(
    "activity" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "target_type" => "Target Type",
            "target_id" => "Target ID",
            "action" => "Action",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "metadata" => "Metadata",
            "ip_address" => "IP Address",
            "user_agent" => "User Agent",
            "referer" => "Referer",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at")
        )
    ),

    "apikey" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "token" => "Access token",
            "enabled" => "Enabled",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        ),
        "enabled" => array(
            "yes" => "Yes",
            "no" => "No"
        )
    ),

    "data" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "data_source" => "Data Source",
            "data_source_id" => "Data Source ID",
            "tool" => "Tool",
            "tool_id" => "Tool ID",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "data_type" => "Data Type",
            "data_type_id" => "Data Type ID",
            "value" => "Value",
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
            "homepage" => "Homepage",
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
            "label" => "Label",
            "slug" => Lang::get("shared.slug"),
            "description" => Lang::get("shared.description"),
            "rdf_mapping" => "RDF mapping",
            "linkable" => "Linkable",
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
        ),
        "linkable" => array(
            "yes" => "Yes",
            "no" => "No"
        ),
    ),

    "login" => array(
        "attributes" => array(
            "id" => Lang::get("shared.id"),
            "user" => Lang::get("shared.user"),
            "user_id" => Lang::get("shared.user_id"),
            "ip_address" => "IP Address",
            "user_agent" => "User Agent",
            "referer" => "Referer",
            "via_remember" => "Via Remember",
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
            "email_address" => "Email address",
            "password" => "Password",
            "password_confirmation" => "Password Confirmation",
            "name" => Lang::get("shared.name"),
            "locale" => "Locale",
            "active" => "Active",
            "user_level" => "User Level",
            "remember_token" => "Remember Token",
            "logins" => "Logins",
            "created_at" => Lang::get("shared.created_at"),
            "updated_at" => Lang::get("shared.updated_at"),
            "deleted_at" => Lang::get("shared.deleted_at")
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
    )
);
