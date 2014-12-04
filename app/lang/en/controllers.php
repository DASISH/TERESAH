<?php

return array(
    "admin" => array(
        "authorize" => array(
            "warning" => "Unauthorized request. Insufficient privileges to access the administrative section of TERESAH."
        ),

        "api_keys" => array(
            "store" => array(
                "success" => "API Key was successfully created."
            ),
            "update" => array(
                "success" => "API Key was successfully updated."
            ),
            "destroy" => array(
                "error" => "An error occured while deleting the requested API key. Please try again later.",
                "success" => "API Key was successfully deleted."
            )
        ),

        "data_sources" => array(
            "store" => array(
                "success" => "Data Source was successfully registered."
            ),
            "update" => array(
                "success" => "Data Source was successfully updated."
            ),
            "destroy" => array(
                "error" => "An error occured while deleting the requested Data Source. Please try again later.",
                "success" => "Data Source was successfully deleted."
            )
        ),

        "data_types" => array(
            "store" => array(
                "success" => "Data Type was successfully registered."
            ),
            "update" => array(
                "success" => "Data Type was successfully updated."
            ),
            "destroy" => array(
                "error" => "An error occured while deleting the requested Data Type. Please try again later.",
                "success" => "Data Type was successfully deleted."
            )
        ),

        "tools" => array(
            "store" => array(
                "success" => "Tool was successfully created."
            ),
            "update" => array(
                "success" => "Tool was successfully updated."
            ),
            "destroy" => array(
                "error" => "An error occured while deleting the requested Tool. Please try again later.",
                "success" => "Tool was successfully deleted."
            ),

            "data_sources" => array(
                "store" => array(
                    "error" => "An error occured while attaching the requested Data Source to Tool. Please try again later.",
                    "success" => "Data Source was successfully attached to Tool."
                ),
                "destroy" => array(
                    "error" => "An error occured while detaching the requested Data Source from Tool. Please try again later.",
                    "success" => "Data Source was successfully detached from Tool."
                ),

                "data" => array(
                    "store" => array(
                        "success" => "Data entry was successfully created for the Data Source."
                    ),
                    "update" => array(
                        "success" => "Data entry was successfully updated for the Data Source."
                    ),
                    "destroy" => array(
                        "error" => "An error occured while deleting the requested Data entry from the Data Source. Please try again later.",
                        "success" => "Data entry was successfully deleted from the Data Source."
                    )
                )
            )
        ),

        "users" => array(
            "store" => array(
                "success" => "User Account was successfully created."
            ),
            "update" => array(
                "success" => "User Account was successfully updated."
            ),
            "destroy" => array(
                "error" => "An error occured while deleting the requested User Account. Please try again later.",
                "success" => "User Account was successfully deleted."
            )
        )
    ),

    "api_key" => array(
        "apply" => array(
            "success" => "API Key application successfully created. An adminstrator needs to approve of your application before the key can be used.",
            "error" => "Error while sending application. Please try again later. If error persists, please contact an administrator",
            "application_exist" => "You have already sent an application for an API key."
        ),
        "destroy" => array(
            "success" => "API key was successfully deleted.",
            "error" => "An error occured while deleting the requested API key. Please try again later. If error persists, please contact an administrator"
        )
    ),

    "sessions" => array(
        "auth" => array(
            "info" => "Unauthorized request, please log in."
        ),
        "store" => array(
            "error" => "Incorrect email address or password. Please try again (and make sure your caps lock is off).",
            "success" => "Logged in successfully.",
            "blocked" => "Unauthorized access request. User is blocked."
        ),
        "destroy" => array(
            "success" => "Logged out."
        )
    ),

    "signup" => array(
        "store" => array(
            "success" => "User account was successfully created."
        )
    ),

    "tools" => array(
        "show" => array(
            "no_data_sources_available" => "Unfortunately the Tool requested doesn't have any Data Sources currently available. Please try again later."
        )
    ),

    "users" => array(
        "update" => array(
            "success" => "Profile was successfully updated."
        )
    )
);
