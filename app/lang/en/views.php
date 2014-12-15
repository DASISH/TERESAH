<?php

return array(
    "admin" => array(
        "activities" => array(
            "index" => array(
                "heading" => "Recent activity",
                "listing_results" => "Listing recent activity from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available."
            ),

            "activity" => array(
                "from_ip_address" => "from IP address",
                "on" => "on"
            ),

            "apikey" => array(
                "created" => "added an API Key",
                "created_but_since_deleted" => "added an API Key which has since been deleted",
                "updated" => "updated API Key",
                "updated_but_since_deleted" => "updated API Key which has since been deleted",
                "deleted" => "deleted API Key",
                "deleted_but_since_restored" => "deleted API Key (since been restored)",
                "restored" => "restored API Key",
                "restored_but_since_deleted" => "restored API Key which has since been deleted again"
            ),

            "data" => array(
                "created" => "added a data entry :target_name",
                "created_but_since_deleted" => "added a data entry :target_name which has since been deleted",
                "updated" => "updated data entry :target_name",
                "updated_and_name_changed" => "updated data entry :target_previous_name and renamed data entry to :target_name",
                "updated_but_since_deleted" => "updated data entry :target_name which has since been deleted",
                "deleted" => "deleted data entry :target_name",
                "deleted_but_since_restored" => "deleted data entry :target_name (since been restored)",
                "restored" => "restored data entry :target_name",
                "restored_but_since_deleted" => "restored data entry :target_name which has since been deleted again"
            ),

            "datasource" => array(
                "created" => "added a data source <a href=\":target_link\" title=\"Show Data Source\">:target_name</a>",
                "created_but_since_deleted" => "added a data source :target_name which has since been deleted",
                "updated" => "updated data source <a href=\":target_link\" title=\"Show Data Source\">:target_name</a>",
                "updated_and_name_changed" => "updated data source <a href=\":target_link\" title=\"Show Data Source\">:target_previous_name</a> and renamed data source to <a href=\":target_link\" title=\"Show Data Source\">:target_name</a>",
                "updated_but_since_deleted" => "updated data source :target_name which has since been deleted",
                "deleted" => "deleted data source :target_name",
                "deleted_but_since_restored" => "deleted data source <a href=\":target_link\" title=\"Show Data Source\">:target_name</a> (since been restored)",
                "restored" => "restored data source <a href=\":target_link\" title=\"Show Data Source\">:target_name</a>",
                "restored_but_since_deleted" => "restored data source :target_name which has since been deleted again"
            ),

            "datatype" => array(
                "created" => "added a data type <a href=\":target_link\" title=\"Show Data Type\">:target_name</a>",
                "created_but_since_deleted" => "added a data type :target_name which has since been deleted",
                "updated" => "updated data type <a href=\":target_link\" title=\"Show Data Type\">:target_name</a>",
                "updated_and_name_changed" => "updated data type <a href=\":target_link\" title=\"Show Data Type\">:target_previous_name</a> and renamed data type to <a href=\":target_link\" title=\"Show Data Type\">:target_name</a>",
                "updated_but_since_deleted" => "updated data type :target_name which has since been deleted",
                "deleted" => "deleted data type :target_name",
                "deleted_but_since_restored" => "deleted data type <a href=\":target_link\" title=\"Show Data Type\">:target_name</a> (since been restored)",
                "restored" => "restored data type <a href=\":target_link\" title=\"Show Data Type\">:target_name</a>",
                "restored_but_since_deleted" => "restored data type :target_name which has since been deleted again"
            ),

            "signup" => array(
                "created" => "signed up as a user"
            ),

            "tool" => array(
                "created" => "added a tool <a href=\":target_link\" title=\"Show Tool\">:target_name</a>",
                "created_but_since_deleted" => "added a tool :target_name which has since been deleted",
                "updated" => "updated tool <a href=\":target_link\" title=\"Show Tool\">:target_name</a>",
                "updated_and_name_changed" => "updated tool <a href=\":target_link\" title=\"Show Tool\">:target_previous_name</a> and renamed tool to <a href=\":target_link\" title=\"Show Tool\">:target_name</a>",
                "updated_but_since_deleted" => "updated tool :target_name which has since been deleted",
                "deleted" => "deleted tool :target_name",
                "deleted_but_since_restored" => "deleted tool <a href=\":target_link\" title=\"Show Tool\">:target_name</a> (since been restored)",
                "restored" => "restored tool <a href=\":target_link\" title=\"Show Tool\">:target_name</a>",
                "restored_but_since_deleted" => "restored tool :target_name which has since been deleted again"
            ),

            "user" => array(
                "created" => "created a user account for <a href=\":target_link\" title=\"Show User Account\">:target_name</a>",
                "created_but_since_deleted" => "created a user account for :target_name which has since been deleted",
                "updated" => "updated <a href=\":target_link\" title=\"Show User Account\">user account</a>",
                "updated_and_name_changed" => "updated user account and changed name from :target_previous_name to <a href=\":target_link\" title=\"Show User Account\">:target_name</a>",
                "updated_for_user" => "updated user account for <a href=\":target_link\" title=\"Show User Account\">:target_name</a>",
                "updated_for_user_and_name_changed" => "updated user account for <a href=\":target_link\" title=\"Show User Account\">:target_previous_name</a> and changed user's name to <a href=\":target_link\" title=\"Show User Account\">:target_name</a>",
                "updated_but_since_deleted" => "updated user account for :target_name which has since been deleted",
                "deleted" => "deleted user account :target_name",
                "deleted_but_since_restored" => "deleted user account <a href=\":target_link\" title=\"Show User Account\">:target_name</a> (since been restored)",
                "restored" => "restored user account <a href=\":target_link\" title=\"Show User Account\">:target_name</a>",
                "restored_but_since_deleted" => "restored user account :target_name which has since been deleted again"
            )
        ),

        "api_keys" => array(
            "index" => array(
                "heading" => "API Keys",
                "listing_results" => "Listing API Keys from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available.",
                "actions" => array(
                    "name" => "Actions",
                    "show" => array(
                        "name" => "Show",
                        "title" => "Show API Key"
                    ),
                    "edit" => array(
                        "name" => "Edit",
                        "title" => "Edit API Key"
                    ),
                    "delete" => array(
                        "name" => "Delete",
                        "title" => "Delete API Key",
                        "confirm" => "Are you sure you want to delete the API Key \":token\" for the user \":user\" and revoke the API access?"
                    )
                )
            ),

            "form" => array(
                "enabled" => array(
                    "label" => "API Access",
                    "name" => "Enabled"
                ),
                "select_user" => array(
                    "label" => "Select User Account",
                    "placeholder" => "Select User Account"
                ),
                "token" => array(
                    "label" => "API Access Token",
                    "placeholder" => "API Access Token"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Add API Key"
                ),
                "heading" => "Add an API Key"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Update API Key"
                ),
                "heading" => "Edit API Key"
            )
        ),

        "data_sources" => array(
            "index" => array(
                "heading" => "Data Sources",
                "listing_results" => "Listing Data Sources from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available.",
                "actions" => array(
                    "name" => "Actions",
                    "show" => array(
                        "name" => "Show",
                        "title" => "Show Data Source"
                    ),
                    "edit" => array(
                        "name" => "Edit",
                        "title" => "Edit Data Source"
                    ),
                    "delete" => array(
                        "name" => "Delete",
                        "title" => "Delete Data Source",
                        "confirm" => "Are you sure you want to delete the Data Source \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Name",
                    "placeholder" => "Name"
                ),
                "description" => array(
                    "label" => "Description",
                    "placeholder" => "Description"
                ),
                "homepage" => array(
                    "label" => "Homepage",
                    "placeholder" => "Homepage"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Add Data Source"
                ),
                "heading" => "Add a Data Source"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Update Data Source"
                ),
                "heading" => "Edit Data Source"
            )
        ),

        "data_types" => array(
            "index" => array(
                "heading" => "Data Types",
                "listing_results" => "Listing Data Types from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available.",
                "actions" => array(
                    "name" => "Actions",
                    "show" => array(
                        "name" => "Show",
                        "title" => "Show Data Type"
                    ),
                    "edit" => array(
                        "name" => "Edit",
                        "title" => "Edit Data Type"
                    ),
                    "delete" => array(
                        "name" => "Delete",
                        "title" => "Delete Data Type",
                        "confirm" => "Are you sure you want to delete the Data Type \":label\"?"
                    )
                )
            ),

            "form" => array(
                "label" => array(
                    "label" => "Label",
                    "placeholder" => "Label"
                ),
                "description" => array(
                    "label" => "Description",
                    "placeholder" => "Description"
                ),
                "rdf_mapping" => array(
                    "label" => "RDF mapping",
                    "placeholder" => "RDF mapping"
                ),
                "linkable" => array(
                    "label" => "Linkable",
                    "placeholder" => ""
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Add Data Type"
                ),
                "heading" => "Add a Data Type"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Update Data Type"
                ),
                "heading" => "Edit Data Type"
            )
        ),

        "tools" => array(
            "navigation" => array(
                "tool" => array(
                    "name" => "Tool",
                    "title" => "Show Tool"
                ),
                "data_sources" => array(
                    "name" => "Data Sources",
                    "title" => "Show Data Sources"
                )
            ),

            "index" => array(
                "heading" => "Tools",
                "listing_results" => "Listing Tools from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available.",
                "actions" => array(
                    "name" => "Actions",
                    "show" => array(
                        "name" => "Show",
                        "title" => "Show Tool"
                    ),
                    "edit" => array(
                        "name" => "Edit",
                        "title" => "Edit Tool"
                    ),
                    "delete" => array(
                        "name" => "Delete",
                        "title" => "Delete Tool",
                        "confirm" => "Are you sure you want to delete the Tool \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Name",
                    "placeholder" => "Name"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Add Tool"
                ),
                "heading" => "Add a Tool"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Update Tool"
                ),
                "heading" => "Edit Tool"
            ),

            "data_sources" => array(
                "navigation" => array(
                    "index" => array(
                        "name" => "List Data Sources",
                        "title" => "List Data Sources"
                    ),
                    "show" => array(
                        "name" => "Show Tool Data",
                        "title" => "Show Tool Data"
                    ),
                    "create" => array(
                        "name" => "Add Data Source",
                        "title" => "Add Data Source"
                    ),
                    "destroy" => array(
                        "name" => "Remove Data Source",
                        "title" => "Remove Data Source",
                        "confirm" => "Are you sure you want to detach the Data Source \":name\" from Tool?"
                    ),
                    "data" => array(
                        "create" => array(
                            "name" => "Add Tool Data",
                            "title" => "Add Tool Data"
                        )
                    )
                ),

                "form" => array(
                    "select_data_source" => array(
                        "label" => "Select Data Source",
                        "placeholder" => "Select Data Source"
                    )
                ),

                "create" => array(
                    "form" => array(
                        "submit" => "Attach Data Source"
                    ),
                    "heading" => "Attach a Data Source"
                ),

                "show" => array(
                    "heading" => array(
                        "available_data" => "Available Data"
                    ),
                    "actions" => array(
                        "name" => "Actions",
                        "edit" => array(
                            "name" => "Edit",
                            "title" => "Edit Data"
                        ),
                        "delete" => array(
                            "name" => "Delete",
                            "title" => "Delete Data",
                            "confirm" => "Are you sure you want to delete the Data Type entry \":label\"?"
                        )
                    ),
                    "messages" => array(
                        "no_data" => "No Data available on Data Source.",
                        "no_data_sources" => "No Data Sources attached to Tool."
                    )
                ),

                "data" => array(
                    "form" => array(
                        "data_type" => array(
                            "label" => "Data Type",
                            "placeholder" => "Data Type"
                        ),
                        "value" => array(
                            "label" => "Value",
                            "placeholder" => "Value"
                        )
                    ),

                    "create" => array(
                        "form" => array(
                            "submit" => "Add Data"
                        ),
                        "heading" => "Add Data to Data Source"
                    ),

                    "edit" => array(
                        "form" => array(
                            "submit" => "Update Data"
                        ),
                        "heading" => "Edit Data under the Data Source"
                    )
                )
            )
        ),

        "users" => array(
            "index" => array(
                "heading" => "Users",
                "listing_results" => "Listing users from <span class=\"label round\">:from</span> to <span class=\"label round\">:to</span> of <span class=\"label round\">:total</span> available.",
                "actions" => array(
                    "name" => "Actions",
                    "show" => array(
                        "name" => "Show",
                        "title" => "Show User"
                    ),
                    "edit" => array(
                        "name" => "Edit",
                        "title" => "Edit User"
                    ),
                    "delete" => array(
                        "name" => "Delete",
                        "title" => "Delete User",
                        "confirm" => "Are you sure you want to delete the User Account \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Name",
                    "placeholder" => "Name"
                ),
                "locale" => array(
                    "label" => "Locale",
                    "placeholder" => "Select locale..."
                ),
                "email_address" => array(
                    "label" => "Email address",
                    "placeholder" => "Email address"
                ),
                "password" => array(
                    "label" => "Password",
                    "placeholder" => "Password"
                ),
                "password_confirmation" => array(
                    "label" => "Password confirmation",
                    "placeholder" => "Repeat password"
                ),
                "active" => array(
                    "label" => "User Account State",
                    "name" => "Active"
                ),
                "user_level" => array(
                    "label" => "User Account Level",
                    "select_user_level" => "Select a user level"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Create User Account"
                ),
                "heading" => "Create a User Account"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Update User Account"
                ),
                "heading" => "Edit User Account"
            )
        )
    ),

    "password_reset" => array(
        "request" => array(
            "form" => array(
                "submit" => "Reset my password"
            ),
            "heading" => "Forgot your password?",
            "email_sent" => "Email with password reset information sent to ",
            "invalid_token" => "Invalid password reset link. Please try again. If the error persists, please contact an administrator."
        ),

        "reset" => array(
            "form" => array(
                "submit" => "Update password"
            ),
            "heading" => "Update your password",
            "invalid_token" => "Invalid password reset link. Please try again. If the error persists, please contact an administrator.",
            "password_updated" => "New password set"
        )
    ),

    "sessions" => array(
        "form" => array(
            "email_address" => array(
                "label" => "Email address",
                "placeholder" => "Email address"
            ),
            "password" => array(
                "label" => "Password",
                "placeholder" => "Password"
            ),
            "submit" => "Sign in",
            "forgot_password" => array(
                "name" => "Forgot password",
                "title" => "Forgot password"
            ),
            "sign_up" => array(
                "not_a_user" => "Not a user?",
                "name" => "Sign up",
                "title" => "Sign up"
            ),
            "sign_in" => array(
                "facebook" => "Sign in via Facebook",
                "googleplus" => "Sign in via Google Plus",
                "linkedin" => "Sign in via Linked In"
            )
        ),

        "create" => array(
            "heading" => "Sign in"
        )
    ),

    "signup" => array(
        "form" => array(
            "name" => array(
                "label" => "Name",
                "placeholder" => "Name"
            ),
            "locale" => array(
                "label" => "Locale",
                "placeholder" => "Select locale..."
            ),
            "email_address" => array(
                "label" => "Email address",
                "placeholder" => "Email address"
            ),
            "password" => array(
                "label" => "Password",
                "placeholder" => "Password"
            ),
            "password_confirmation" => array(
                "label" => "Password confirmation",
                "placeholder" => "Repeat password"
            )
        ),

        "create" => array(
            "form" => array(
                "submit" => "Sign up"
            ),
            "heading" => "Sign up"
        )
    ),

    "shared" => array(
        "form" => array(
            "error" => array(
                "message" => "We are terribly sorry, but following errors prohibited us to process the form. Please, review the form."
            ),
            "email_missing" => "Email address is mandatory",
            "cancel" => "cancel",
            "or" => "or",
            "select_locale" => "Select a locale"
        ),

        "locales" => array(
            "en" => "English",
            "sv" => "Svenska"
        ),

        "messages" => array(
            "admin" => array(
                "warning" => array(
                    "highlight" => "Please, be careful!",
                    "message" => "You are currently in an administrative section of TERESAH."
                )
            ),
            "close" => "Close",
            "current_version" => array(
                "commit_id" => array(
                    "error" => "Error: Unable to retrieve the current commit ID.",
                    "message" => "version (current commit ID):"
                ),
                "commit_date" => array(
                    "error" => "Error: Unable to retrieve the current commit date."
                )
            )
        ),

        "meta" => array(
            "author" => "DASISH",
            "description" => "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.",
            "keywords" => "applications, knowledge, libraries, methodologies, methods, registry, researchers, services, software, standards, tools, CESSDA, CLARIN, DARIAH, ESFRI, ESS, SHARE, TERESAH",
            "title" => "TERESAH",
        ),

        "navigation" => array(
            "teresah" => array(
                "name" => "TERESAH",
                "title" => "Home"
            ),
            
            "admin" => array(
                "home" => array(
                    "name" => "Admin home",
                    "title" => "Admin home"
                ),

                "dashboard" => array(
                    "name" => "Dashboard",
                    "title" => "Dashboard"
                ),

                "activities" => array(
                    "name" => "Activities",
                    "title" => "Activities"
                ),

                "api" => array(
                    "name" => "API",
                    "title" => "API",
                    "create" => array(
                        "name" => "Add an API Key",
                        "title" => "Add an API Key"
                    ),
                    "index" => array(
                        "name" => "Manage API Keys",
                        "title" => "Manage API Keys"
                    )
                ),

                "data_sources" => array(
                    "name" => "Data Sources",
                    "title" => "Data Sources",
                    "show" => array(
                        "name" => "View Data Source",
                        "title" => "View Data Source"
                    ),
                    "create" => array(
                        "name" => "Add a Data Source",
                        "title" => "Add a Data Source"
                    ),
                    "edit" => array(
                        "name" => "Edit Data Source",
                        "title" => "Edit Data Source"
                    ),
                    "index" => array(
                        "name" => "Manage Data Sources",
                        "title" => "Manage Data Sources"
                    )
                ),

                "data_types" => array(
                    "name" => "Data Types",
                    "title" => "Data Types",
                    "show" => array(
                        "name" => "View Data Type",
                        "title" => "View Data Type"
                    ),
                    "create" => array(
                        "name" => "Add a Data Type",
                        "title" => "Add a Data Type"
                    ),
                    "edit" => array(
                        "name" => "Edit Data Type",
                        "title" => "Edit Data Type"
                    ),
                    "index" => array(
                        "name" => "Manage Data Types",
                        "title" => "Manage Data Types"
                    )
                ),

                "tools" => array(
                    "name" => "Tools",
                    "title" => "Tools",
                    "show" => array(
                        "name" => "View Tool",
                        "title" => "View Tool"
                    ),
                    "create" => array(
                        "name" => "Add a Tool",
                        "title" => "Add a Tool"
                    ),
                    "edit" => array(
                        "name" => "Edit Tool",
                        "title" => "Edit Tool"
                    ),
                    "index" => array(
                        "name" => "Manage Tools",
                        "title" => "Manage Tools"
                    )
                ),

                "users" => array(
                    "name" => "Users",
                    "title" => "Users",
                    "show" => array(
                        "name" => "View User Account",
                        "title" => "View User Account"
                    ),
                    "create" => array(
                        "name" => "Create a new User Account",
                        "title" => "Create a new User Account"
                    ),
                    "edit" => array(
                        "name" => "Edit User Account",
                        "title" => "Edit User Account"
                    ),
                    "index" => array(
                        "name" => "Manage User Accounts",
                        "title" => "Manage User Accounts"
                    )
                ),

                "switch" => array(
                    "name" => "Browse TERESAH",
                    "title" => "Switch to browse TERESAH"
                )
            ),

            "dasish" => array(
                "name" => "DASISH",
                "title" => "DASISH",
                "href" => "http://dasish.eu/"
            ),

            "home" => array(
                "name" => "Home",
                "title" => "Home"
            ),

            "browse" => array(
                "name" => "Browse Tools by",
                "title" => "Browse Tools by",
                "all" => array(
                    "name" => "Browse All",
                    "title" => "Browse All"
                ),
                "facets" => array(
                    "name" => "Browse Facets",
                    "title" => "Browse Facets"
                ),
                "by_alphabet" => array(
                    "name" => "By Alphabet"
                ),
                "by_facet" => array(
                    "name" => "By Facet"
                ),
                "popular" => array(
                    "name" => "Most Popular Tools",
                    "title" => "Most Popular"
                ),
                "search" => array(
                    "name" => "Search",
                    "title" => "Search"
                )
            ),

            "search" => array(
                "name" => "Search",
                "title" => "Search",
                "placeholder" => "Search...",
                "faceted" => array(
                    "name" => "Faceted",
                    "title" => "Faceted"
                ),
                "general" => array(
                    "name" => "General",
                    "title" => "General"
                )
            ),

            "about" => array(
                "name" => "About",
                "title" => "About",
                "teresah" => array(
                    "name" => "TERESAH",
                    "title" => "About TERESAH"
                ),
                "api" => array(
                    "name" => "API",
                    "title" => "API"
                ),
                "rdf" => array(
                    "name" => "RDF",
                    "title" => "RDF"
                ),
                "privacy_policy" => array(
                    "name" => "Privacy Policy",
                    "title" => "Privacy Policy"
                ),
                "license" => array(
                    "name" => "License and Citing",
                    "title" => "License and Citing"
                )
            ),

            "fork" => array(
                "name" => "TERESAH on GitHub"
            ),

            "contribute" => array(
                "name" => "Contribute",
                "title" => "Contribute"
            ),

            "edit_user_profile" => array(
                "name" => "Edit Profile",
                "title" => "Edit Profile"
            ),

            "edit_user_api_keys" => array(
                "name" => "Manage API Keys",
                "title" => "Manage API Keys"
            ),

            "edit_user_tools" => array(
                "name" => "My Tools",
                "title" => "My Tools"
            ),

            "switch" => array(
                "name" => "Manage TERESAH",
                "title" => "Switch to administrative section of TERESAH"
            ),

            "login" => array(
                "name" => "Sign in",
                "title" => "Login",
                "login_via" => "Login via"
            ),

            "logout" => array(
                "name" => "Logout",
                "title" => "Logout"
            )
        )
    ),

    "tools" => array(
        "index" => array(
            "heading" => "Tools",
            "listing_results" => "Listing Tools from <span class=\"badge\">:from</span> to <span class=\"badge\">:to</span> of <span class=\"badge\">:total</span> available.",
            "accending" => "accending",
            "descending" => "descending",
            "not_found" => "No tools found"
        ),

        "by_facet" => array(
            "index" => array(
                "heading" => "By facet",
                "listing_results" => "Listing facets from <span class=\"badge\">:from</span> to <span class=\"badge\">:to</span> of <span class=\"badge\">:total</span> available."
            )
        ),

        "data_sources" => array(
            "show" => array(
                "heading" => array(
                    "available_data" => "Available Data"
                ),
                "on" => "on",
                "messages" => array(
                    "no_data" => "No Data available on Data Source.",
                    "no_data_sources" => "No Data Sources attached to Tool."
                ),
                "use" => array(
                    "title" => "Add to 'My Tools'"
                ),
                "unuse" => array(
                    "title" => "Remove from 'My Tools'"
                ),
                "similar_tools" => "Similar Tools",
                "share" => "Share",
                "export" => "Export",
                "available_data_formats" => "Available Data Formats"
            )
        ),

        "popular" => array(
            "heading" => "Most popular tools",
        ),

        "search" => array(
            "form" => array(
                "search" => array(
                    "label" => "Search",
                    "placeholder" => "Find tools, services, methodologies and more..."
                )
            ),

            "index" => array(
                "heading" => "Search Tools",
                "list_more" => "List :num more",
            )
        )
    ),

    "users" => array(
        "api_key" => array(
            "heading" => "API keys",
            "api-key" => "Key",
            "created_at" => "Created at",
            "description" => "Description",
            "description-empty" => "Click to add description",
            "actions" => array(
                "name" => "Actions",
                "remove" => array(
                    "title" => "Remove API key",
                    "confirm" => "Are you sure you want to remove the API key?"
                )
            ),
            "apply" => "Apply for API key"
        ),

        "form" => array(
            "heading" => "Profile details",
            "name" => array(
                "label" => "Name",
                "placeholder" => "Name"
            ),
            "locale" => array(
                "label" => "Locale"
            ),
            "email_address" => array(
                "label" => "Email address",
                "placeholder" => "Email address"
            ),
            "password" => array(
                "label" => "New password",
                "placeholder" => "New password"
            ),
            "password_confirmation" => array(
                "label" => "New password confirmation",
                "placeholder" => "Repeat new password"
            )
        ),

        "edit" => array(
            "form" => array(
                "submit" => "Update profile"
            ),
            "heading" => "Edit Profile"
        ),

        "tools" => array(
            "heading" => "My tools",
            "name" => "My tools",
            "empty" => "You have not added any tools to this list",
            "actions" => array(
                "name" => "Actions",
                "remove" => array(
                    "title" => "Remove from list",
                    "confirm" => "Are you sure you want to remove the tool from the list?"
                )
            )
        )
    )
);
