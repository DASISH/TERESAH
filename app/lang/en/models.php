<?php

return array(
    "activity" => array(
        "attributes" => array(
            "id" => "ID",
            "target_type" => "Target Type",
            "target_id" => "Target ID",
            "action" => "Action",
            "user" => "User",
            "user_id" => "User ID",
            "metadata" => "Metadata",
            "ip_address" => "IP Address",
            "user_agent" => "User Agent",
            "referer" => "Referer",
            "created_at" => "Created at",
            "updated_at" => "Updated at"
        )
    ),

    "apikey" => array(
        "attributes" => array(
            "id" => "ID",
            "user" => "User",
            "user_id" => "User ID",
            "token" => "Access token",
            "enabled" => "Enabled",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        ),
        "enabled" => array(
            "yes" => "Yes",
            "no" => "No"
        )
    ),

    "data" => array(
        "attributes" => array(
            "id" => "ID",
            "data_source" => "Data Source",
            "data_source_id" => "Data Source ID",
            "tool" => "Tool",
            "tool_id" => "Tool ID",
            "user" => "User",
            "user_id" => "User ID",
            "data_type" => "Data Type",
            "data_type_id" => "Data Type ID",
            "value" => "Value",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        )
    ),

    "datasource" => array(
        "attributes" => array(
            "id" => "ID",
            "name" => "Name",
            "description" => "Description",
            "homepage" => "Homepage",
            "user" => "User",
            "user_id" => "User ID",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        )
    ),

    "datatype" => array(
        "attributes" => array(
            "id" => "ID",
            "label" => "Label",
            "slug" => "Slug",
            "description" => "Description",
            "rdf_mapping" => "RDF mapping",
            "linkable" => "Linkable",
            "user" => "User",
            "user_id" => "User ID",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        ),
        "linkable" => array(
            "yes" => "Yes",
            "no" => "No"
        ),
    ),

    "login" => array(
        "attributes" => array(
            "id" => "ID",
            "user" => "User",
            "user_id" => "User ID",
            "ip_address" => "IP Address",
            "user_agent" => "User Agent",
            "referer" => "Referer",
            "via_remember" => "Via Remember",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        )
    ),

    "tool" => array(
        "attributes" => array(
            "id" => "ID",
            "name" => "Name",
            "slug" => "Slug",
            "user" => "User",
            "user_id" => "User ID",
            "created_at" => "Created at",
            "updated_at" => "Updated at",
            "deleted_at" => "Deleted at"
        )
    ),

    "user" => array(
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
    )
);
