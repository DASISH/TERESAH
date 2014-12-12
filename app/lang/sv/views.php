<?php

return array(
    "admin" => array(
        "activities" => array(
            "index" => array(
                "heading" => "Senaste aktiviteter",
                "listing_results" => "Listar senaste aktiviteter från <span class=\"label round\">:from</span> till <span class=\"label round\">:to</span> av <span class=\"label round\">:total</span> tillgängliga."
            ),

            "activity" => array(
                "from_ip_address" => "från IP-adress",
                "on" => "på"
            ),

            "data" => array(
                "created" => "Skapade informationspost :target_name",
                "created_but_since_deleted" => "Skapade informationspost :target_name, men denna har sedan raderats",
                "updated" => "Uppdaterade informationspost :target_name",
                "updated_and_name_changed" => "Uppdaterade informationspost :target_previous_name och ändrade namnet till :target_name",
                "updated_but_since_deleted" => "Uppdaterade informationspost :target_name, men denna har sedan raderats",
                "deleted" => "Raderade informationspost :target_name",
                "deleted_but_since_restored" => "Raderade informationspost :target_name (har sedan återställts)",
                "restored" => "Återställde informationspost :target_name",
                "restored_but_since_deleted" => "Återställde informationspost :target_name, men denna har sedan återigen raderats"
            ),

            "datasource" => array(
                "created" => "Skapade informationskälla <a href=\":target_link\" title=\"Visa informationskälla\">:target_name</a>",
                "created_but_since_deleted" => "Skapade informationskälla :target_name, men denna har sedan raderats",
                "updated" => "Uppdaterade informationskälla <a href=\":target_link\" title=\"Visa informationskälla\">:target_name</a>",
                "updated_and_name_changed" => "Uppdaterade informationskälla <a href=\":target_link\" title=\"Visa informationskälla\">:target_previous_name</a> och ändrade namnet till <a href=\":target_link\" title=\"Visa informationskälla\">:target_name</a>",
                "updated_but_since_deleted" => "Uppdaterade informationskälla :target_name, men denna har sedan raderats",
                "deleted" => "Raderade informationskälla :target_name",
                "deleted_but_since_restored" => "Raderade informationskälla <a href=\":target_link\" title=\"Visa informationskälla\">:target_name</a> (har återställts)",
                "restored" => "Återställde informationskälla <a href=\":target_link\" title=\"Visa informationskälla\">:target_name</a>",
                "restored_but_since_deleted" => "Återställde informationskälla :target_name, men denna har sedan återigen raderats"
            ),

            "datatype" => array(
                "created" => "Skapade datatyp <a href=\":target_link\" title=\"Visa datatyp\">:target_name</a>",
                "created_but_since_deleted" => "Skapade datatyp :target_name, men denna har sedan raderats",
                "updated" => "Uppdaterade datatyp <a href=\":target_link\" title=\"Visa datatyp\">:target_name</a>",
                "updated_and_name_changed" => "Uppdaterade datatyp <a href=\":target_link\" title=\"Visa datatyp\">:target_previous_name</a> och ändrade namnet till <a href=\":target_link\" title=\"Visa datatyp\">:target_name</a>",
                "updated_but_since_deleted" => "Uppdaterade datatyp :target_name, men denna har sedan raderats",
                "deleted" => "Raderade datatyp :target_name",
                "deleted_but_since_restored" => "Raderade datatyp <a href=\":target_link\" title=\"Visa datatyp\">:target_name</a> (har sedan återställts)",
                "restored" => "Återställde datatyp <a href=\":target_link\" title=\"Visa datatyp\">:target_name</a>",
                "restored_but_since_deleted" => "Återställde datatyp :target_name, men denna har sedan återigen raderats"
            ),

            "signup" => array(
                "created" => "Skapade ett användarkonto"
            ),

            "tool" => array(
                "created" => "Skapade verktyg <a href=\":target_link\" title=\"Visa verktyg\">:target_name</a>",
                "created_but_since_deleted" => "Skapade verktyg :target_name, men denna har sedan raderats",
                "updated" => "Uppdaterade verktyg <a href=\":target_link\" title=\"Visa verktyg\">:target_name</a>",
                "updated_and_name_changed" => "Uppdaterade verktyg <a href=\":target_link\" title=\"Visa verktyg\">:target_previous_name</a> och ändrade namnet till <a href=\":target_link\" title=\"Visa verktyg\">:target_name</a>",
                "updated_but_since_deleted" => "Uppdaterade verktyg :target_name, men denna har sedan raderats",
                "deleted" => "Raderade verktyg :target_name",
                "deleted_but_since_restored" => "Raderade verktyg <a href=\":target_link\" title=\"Visa verktyg\">:target_name</a> (har sedan återställts)",
                "restored" => "Återställde verktyg <a href=\":target_link\" title=\"Visa verktyg\">:target_name</a>",
                "restored_but_since_deleted" => "Återställde verktyg :target_name, men denna har sedan återigen raderats"
            ),

            "user" => array(
                "created" => "Skapade användarkonto för <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a>",
                "created_but_since_deleted" => "Skapade användarkonto för :target_name, men denna har sedan raderats",
                "updated" => "Uppdaterade <a href=\":target_link\" title=\"Visa användarkonto\">användarkonto</a>",
                "updated_and_name_changed" => "Uppdaterade användarkonto och ändrade namn från :target_previous_name till <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a>",
                "updated_for_user" => "Uppdaterade användarkonto för <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a>",
                "updated_for_user_and_name_changed" => "Uppdaterade användarkonto för <a href=\":target_link\" title=\"Visa användarkonto\">:target_previous_name</a> och ändrade användarens namn till <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a>",
                "updated_but_since_deleted" => "Uppdaterade användarkonto för :target_name, men denna har sedan raderats",
                "deleted" => "Raderade användarkonto :target_name",
                "deleted_but_since_restored" => "Raderade användarkonto <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a> (har sedan återställts)",
                "restored" => "Återställde användarkonto <a href=\":target_link\" title=\"Visa användarkonto\">:target_name</a>",
                "restored_but_since_deleted" => "Återställde användarkonto :target_name, men denna har sedan återigen raderats"
            )
        ),

        "data_sources" => array(
            "index" => array(
                "heading" => "Informationskällor",
                "listing_results" => "Listar informationskällor från <span class=\"label round\">:from</span> till <span class=\"label round\">:to</span> av <span class=\"label round\">:total</span> tillgängliga.",
                "actions" => array(
                    "name" => "Handlingar",
                    "show" => array(
                        "name" => "Visa",
                        "title" => "Visa informationskälla"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera",
                        "title" => "Uppdatera informationskälla"
                    ),
                    "delete" => array(
                        "name" => "Radera",
                        "title" => "Radera informationskälla",
                        "confirm" => "Är du säker på att du vill radera informationskällan \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Namn",
                    "placeholder" => "Namn"
                ),
                "description" => array(
                    "label" => "Beskrivning",
                    "placeholder" => "Beskrivning"
                ),
                "homepage" => array(
                    "label" => "Hemsida",
                    "placeholder" => "Hemsida"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Skapa informationskälla"
                ),
                "heading" => "Skapa informationskälla"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Uppdatera informationskälla"
                ),
                "heading" => "Uppdatera informationskälla"
            )
        ),

        "data_types" => array(
            "index" => array(
                "heading" => "Datatyper",
                "listing_results" => "Listar datatyper från <span class=\"label round\">:from</span> till <span class=\"label round\">:to</span> av <span class=\"label round\">:total</span> tillgängliga.",
                "actions" => array(
                    "namn" => "Handlingar",
                    "show" => array(
                        "name" => "Visa",
                        "title" => "Visa datatyp"
                    ),
                    "edit" => array(
                        "namn" => "Uppdatera",
                        "title" => "Uppdatera datatyp"
                    ),
                    "delete" => array(
                        "name" => "Radera",
                        "title" => "Radera datatyp",
                        "confirm" => "Är du säker på att du vill radera datatypen \":label\"?"
                    )
                )
            ),

            "form" => array(
                "label" => array(
                    "label" => "Etikett",
                    "placeholder" => "Etikett"
                ),
                "description" => array(
                    "label" => "Beskriving",
                    "placeholder" => "Beskrivning"
                ),
                "rdf_mapping" => array(
                    "label" => "RDF-mappning",
                    "placeholder" => "RDF-mappning"
                ),
                "linkable" => array(
                    "label" => "Linkable",
                    "placeholder" => "Länkbar"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Skapa datatyp"
                ),
                "heading" => "Skapa datatyp"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Uppdatera datatyp"
                ),
                "heading" => "Uppdatera datatyp"
            )
        ),

        "tools" => array(
            "navigation" => array(
                "tool" => array(
                    "name" => "Verktyg",
                    "title" => "Visa verktyg"
                ),
                "data_sources" => array(
                    "name" => "Informationskällor",
                    "title" => "Visa informationskällor"
                )
            ),

            "index" => array(
                "heading" => "Verktyg",
                "listing_results" => "Listar verktyg från <span class=\"label round\">:from</span> till <span class=\"label round\">:to</span> av <span class=\"label round\">:total</span> tillgängliga.",
                "actions" => array(
                    "name" => "Handlingar",
                    "show" => array(
                        "name" => "Visa",
                        "title" => "Visa verktyg"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera",
                        "title" => "Uppdatera verktyg"
                    ),
                    "delete" => array(
                        "name" => "Radera",
                        "title" => "Radera verktyg",
                        "confirm" => "Är du säker på att du vill radera verktyget \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Namn",
                    "placeholder" => "Namn"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Skapa verktyg"
                ),
                "heading" => "Skapa verktyg"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Uppdatera verktyg"
                ),
                "heading" => "Uppdatera verktyg"
            ),

            "data_sources" => array(
                "navigation" => array(
                    "index" => array(
                        "name" => "Lista informationskällor",
                        "title" => "Lista informationskällor"
                    ),
                    "show" => array(
                        "name" => "Visa verktygsinformation",
                        "title" => "Visa verktygsinformation"
                    ),
                    "create" => array(
                        "name" => "Lägg till informationskälla",
                        "title" => "Lägg till informationskälla"
                    ),
                    "destroy" => array(
                        "name" => "Ta bort informationskälla",
                        "title" => "Ta bort informationskälla",
                        "confirm" => "Är du säker på att du vill koppla loss informationskällan \":name\" från verktyget?"
                    ),
                    "data" => array(
                        "create" => array(
                            "name" => "Lägg till verktygsinformation",
                            "title" => "Lägg till verktygsinformation"
                        )
                    )
                ),

                "form" => array(
                    "select_data_source" => array(
                        "label" => "Välj informationskälla",
                        "placeholder" => "Välj informationskälla"
                    )
                ),

                "create" => array(
                    "form" => array(
                        "submit" => "Anslut informationskälla"
                    ),
                    "heading" => "Anslut en informationskälla"
                ),

                "show" => array(
                    "heading" => array(
                        "available_data" => "Tillgänglig information"
                    ),
                    "actions" => array(
                        "name" => "Handlingar",
                        "edit" => array(
                            "name" => "Uppdatera",
                            "title" => "Uppdatera informationsposter"
                        ),
                        "delete" => array(
                            "name" => "Radera",
                            "title" => "Radera data",
                            "confirm" => "Är du säker på att du vill radera datatypen \":label\"?"
                        )
                    ),
                    "messages" => array(
                        "no_data" => "Ingen data finns om denna informationskälla",
                        "no_data_sources" => "Inga informationskällor är anslutna till verktyget."
                    )
                ),

                "data" => array(
                    "form" => array(
                        "data_type" => array(
                            "label" => "Datatyp",
                            "placeholder" => "Datatyp"
                        ),
                        "value" => array(
                            "label" => "Värde",
                            "placeholder" => "Värde"
                        )
                    ),

                    "create" => array(
                        "form" => array(
                            "submit" => "Skapa informationspost"
                        ),
                        "heading" => "Skapa informationspost för informationskälla"
                    ),

                    "edit" => array(
                        "form" => array(
                            "submit" => "Uppdatera informationspost"
                        ),
                        "heading" => "Uppdatera informationspost för informationskälla"
                    )
                )
            )
        ),

        "users" => array(
            "index" => array(
                "heading" => "Användare",
                "listing_results" => "Listar användare från <span class=\"label round\">:from</span> till <span class=\"label round\">:to</span> av <span class=\"label round\">:total</span> tillgängliga.",
                "actions" => array(
                    "name" => "Handlingar",
                    "show" => array(
                        "name" => "Visa",
                        "title" => "Visa användare"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera",
                        "title" => "Uppdatera användare"
                    ),
                    "delete" => array(
                        "name" => "Radera",
                        "title" => "Radera användare",
                        "confirm" => "Är du säker på att du vill radera användaren \":name\"?"
                    )
                )
            ),

            "form" => array(
                "name" => array(
                    "label" => "Namn",
                    "placeholder" => "Namn"
                ),
                "locale" => array(
                    "label" => "Språk",
                    "placeholder" => "Välj språk..."
                ),
                "email_address" => array(
                    "label" => "Epostadress",
                    "placeholder" => "Epostadress"
                ),
                "password" => array(
                    "label" => "Lösenord",
                    "placeholder" => "Lösenord"
                ),
                "password_confirmation" => array(
                    "label" => "Repetera lösenord",
                    "placeholder" => "Repetera lösenord"
                ),
                "active" => array(
                    "label" => "Status för användarkonto",
                    "namn" => "Aktivt"
                ),
                "user_level" => array(
                    "label" => "Användarnivå",
                    "select_user_level" => "Välj en användarnivå"
                )
            ),

            "create" => array(
                "form" => array(
                    "submit" => "Skapa användarkonto"
                ),
                "heading" => "Skapa användarkonto"
            ),

            "edit" => array(
                "form" => array(
                    "submit" => "Uppdatera användarkonto"
                ),
                "heading" => "Uppdatera användarkonto"
            )
        )
    ),

    "password_reset" => array(
        "request" => array(
            "form" => array(
                "submit" => "Återställ mitt lösenord"
            ),
            "heading" => "Glömt lösenordet?",
            "email_sent" => "Mail med information för att återställa lösenordet skickat till ",
            "invalid_token" => "Ej giltig länk för att återställa lösenordet. Var vänlig försök igen. Om problemet kvarstår, kontakta en administratör."
        ),

        "reset" => array(
            "form" => array(
                "submit" => "Uppdatera lösenord"
            ),
            "heading" => "Uppdatera ditt lösenord",
            "invalid_token" => "Ej giltig länk för att återställa lösenordet. Var vänlig försök igen. Om problemet kvarstår, kontakta en administratör.",
            "password_updated" => "Lösenordet uppdaterat"
        )
    ),

    "sessions" => array(
        "form" => array(
            "email_address" => array(
                "label" => "Epostadress",
                "placeholder" => "Epostadress"
            ),
            "password" => array(
                "label" => "Lösenord",
                "placeholder" => "Lösenord"
            ),
            "submit" => "Logga in",
            "forgot_password" => array(
                "name" => "Glömt bort lösenord",
                "title" => "Glömt bort lösenord"
            ),
            "sign_up" => array(
                "not_a_user" => "Är du inte användare?",
                "name" => "Gå med",
                "title" => "Gå med"
            ),
            "sign_in" => array(
                "facebook" => "Logga in via Facebook",
                "googleplus" => "Logga in via Google Plus",
                "linkedin" => "Logga in via Linked In"
            )
        ),

        "create" => array(
            "heading" => "Logga in"
        )
    ),

    "signup" => array(
        "form" => array(
            "name" => array(
                "label" => "Namn",
                "placeholder" => "Namn",
            ),
            "locale" => array(
                "label" => "Språk",
                "placeholder" => "Välj språk..."
            ),
            "email_address" => array(
                "label" => "Epostadress",
                "placeholder" => "Epostadress"
            ),
            "password" => array(
                "label" => "Lösenord",
                "placeholder" => "Lösenord"
            ),
            "password_confirmation" => array(
                "label" => "Bekräfta lösenord",
                "placeholder" => "Upprepa lösenord"
            )
        ),

        "create" => array(
            "form" => array(
                "submit" => "Gå med"
            ),
            "heading" => "Gå med"
        )
    ),

    "shared" => array(
        "form" => array(
            "error" => array(
                "message" => "Vi är hemskt ledsna, men de följande felen gör att vi inte kan behandla formuläret. Kontrollera formuläret."
            ),
            "email_missing" => "E-postadress är obligatoriskt",
            "cancel" => "avbryt",
            "or" => "eller",
            "select_locale" => "Välj språk",
        ),

        "locales" => array(
            "en" => "English",
            "sv" => "Svenska"
        ),

        "messages" => array(
            "admin" => array(
                "warning" => array(
                    "highlight" => "Var försiktig!",
                    "message" => "Du är i en administrativ del av TERESAH."
                )
            ),
            "close" => "Stäng",
            "current_version" => array(
                "commit_id" => array(
                    "error" => "Fel: kan inte hämta ID för nuvarande commit.",
                    "message" => "version (nuvarande commit ID):",
                ),
                "commit_date" => array(
                    "error" => "Fel: kan inte hämta datum för nuvarande commit."
                )
            )
        ),

        "meta" => array(
            "author" => "DASISH",
            "description" => "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) är en tvärvetenskaplig kunskapsbank om verktyg riktad mot forskare inom Samhällsvetenskap och Humaniora. Målet är att tillhandahålla en auktoritativ listning av mjukvaruverktyg som för närvarande används inom dessa vetenskapliga områdena, samt låta dess användare visa på metoder och applikationer av dem.",
            "keywords" => "applikationer, kunskap, bibliotek, metodologier, metoder, register, forskare, servicar, mjukvara, standarder, verktyg, CESSDA, CLARIN, DARIAH, ESFRI, ESS, SHARE, TERESAH",
            "title" => "TERESAH",
        ),

        "navigation" => array(
            "teresah" => array(
                "name" => "TERESAH",
                "title" => "Hem"
            ),
            "admin" => array(
                "home" => array(
                    "name" => "Admin hem",
                    "title" => "Admin hem"
                ),
                "dashboard" => array(
                    "name" => "Kontrollpanel",
                    "title" => "Kontrollpanel"
                ),
                "activities" => array(
                    "name" => "Aktiviteter",
                    "title" => "Aktiviteter"
                ),
                "data_sources" => array(
                    "name" => "Informationskällor",
                    "title" => "Informationskällor",
                    "show" => array(
                        "name" => "Visa informationskälla",
                        "title" => "Visa informationskälla"
                    ),
                    "create" => array(
                        "name" => "Skapa informationskälla",
                        "title" => "Skapa informationskälla"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera informationskälla",
                        "title" => "Uppdatera informationskälla"
                    ),
                    "index" => array(
                        "name" => "Hantera informationskällor",
                        "title" => "Hantera informationskällor"
                    )
                ),
                "data_types" => array(
                    "name" => "Datatyper",
                    "title" => "Datatyper",
                    "show" => array(
                        "name" => "Visa datatyper",
                        "title" => "Visa datatyper"
                    ),
                    "create" => array(
                        "name" => "Skapa datatyp",
                        "title" => "Skapa datatyp"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera datatyp",
                        "title" => "Uppdatera datatyp"
                    ),
                    "index" => array(
                        "name" => "Hantera datatyper",
                        "title" => "Hantera datatyper"
                    )
                ),
                "tools" => array(
                    "name" => "Verktyg",
                    "title" => "Verktyg",
                    "show" => array(
                        "name" => "Visa verktyg",
                        "title" => "Visa verktyg"
                    ),
                    "create" => array(
                        "name" => "Skapa verktyg",
                        "title" => "Skapa verktyg"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera verktyg",
                        "title" => "Uppdatera verktyg"
                    ),
                    "index" => array(
                        "name" => "Hantera verktyg",
                        "title" => "Hantera verktyg"
                    )
                ),
                "users" => array(
                    "name" => "Användare",
                    "title" => "Användare",
                    "show" => array(
                        "name" => "Visa användarkonton",
                        "title" => "Visa användarkonton"
                    ),
                    "create" => array(
                        "name" => "Skapa användarkonto",
                        "title" => "Skapa användarkonto"
                    ),
                    "edit" => array(
                        "name" => "Uppdatera användarkonto",
                        "title" => "Uppdatera användarkonto"
                    ),
                    "index" => array(
                        "name" => "Hantera användarkonton",
                        "title" => "Hantera användarkonton"
                    )
                ),
                "switch" => array(
                    "name" => "Byt till publika delen av TERESAH",
                    "title" => "Byt till publika TERESAH"
                )
            ),
            "dasish" => array(
                "name" => "DASISH",
                "title" => "DASISH",
                "href" => "http://dasish.eu/"
            ),
            "home" => array(
                "name" => "Hem",
                "title" => "Hem"
            ),
            "browse" => array(
                "name" => "Bläddra",
                "title" => "Bläddra",
                "all" => array(
                    "name" => "Alla verktyg",
                    "title" => "Alla verktyg"
                ),
                "facets" => array(
                    "name" => "Facetter",
                    "title" => "Facetter"
                ),
                "by_alphabet" => array(
                    "name" => "Alfabetiskt"
                ),
                "by_facet" => array(
                    "name" => "Facetter"
                ),
                "popular" => array(
                    "name" => "Mest populära verktygen",
                    "title" => "Mest populära"
                ),
                "search" => array(
                    "name" => "Sök",
                    "title" => "Sök"
                )
            ),
            "contribute" => array(
                "title" => "Bidra"
            ),
            "search" => array(
                "name" => "Sök",
                "title" => "Sök",
                "placeholder" => "Sök...",
                "faceted" => array(
                    "name" => "Facetterat",
                    "title" => "Facetterat"
                ),
                "general" => array(
                    "name" => "Generell",
                    "title" => "Generell"
                )
            ),
            "about" => array(
                "name" => "Om",
                "title" => "Om",
                "teresah" => array(
                    "name" => "TERESAH",
                    "title" => "Om TERESAH"
                ),
                "api" => array(
                    "name" => "API",
                    "title" => "API",
                    "documentation" => "API Dokumentation"
                ),
                "rdf" => array(
                    "name" => "RDF",
                    "title" => "RDF",
                    "documentation" => "RDF Dokumentation"
                ),
                "privacy_policy" => array(
                    "name" => "Integritetspolicy",
                    "title" => "Integritetspolicy"
                ),
                "license" => array(
                    "name" => "Licens och Citering",
                    "title" => "Licens och Citering"
                )
            ),
            "fork" => array(
                "name" => "Fork TERESAH på GitHub"
            ),
            "edit_user_profile" => array(
                "name" => "Uppdatera användarprofil",
                "title" => "Uppdatera användarprofil"
            ),
            "edit_user_api_keys" => array(
                "name" => "Hantera API-nycklar",
                "title" => "Hantera API-nycklar"
            ),
            "edit_user_tools" => array(
                "name" => "Mina verktyg",
                "title" => "Mina verktyg"
            ),
            "switch" => array(
                "name" => "Hantera TERESAH",
                "title" => "Byt till administrationssidorna för TERESAH"
            ),
            "login" => array(
                "name" => "Logga in",
                "title" => "Logga in"
            ),
            "logout" => array(
                "name" => "Logga ut",
                "title" => "Logga ut"
            )
        )
    ),

    "tools" => array(
        "index" => array(
            "heading" => "Verktyg",
            "listing_results" => "Listar verktyg från <span class=\"badge\">:from</span> till <span class=\"badge\">:to</span> av <span class=\"badge\">:total</span> tillgängliga.",
            "accending" => "stigande",
            "descending" => "fallande",
            "not_found" => "Inga verktyg hittades"
        ),

        "by_facet" => array(
            "heading" => "Facetter",
            "listing_results" => "Visar värden från <span class=\"badge\">:from</span> till <span class=\"badge\">:to</span> av <span class=\"badge\">:total</span> tillgängliga."
        ),

        "data_sources" => array(
            "show" => array(
                "heading" => array(
                    "available_data" => "Available Data"
                ),
                "on" => "via",
                "messages" => array(
                    "no_data" => "Inga data tillgängliga från informationskällan.",
                    "no_data_sources" => "Inga informationskällor kopplade till verktyget."
                ),
                "use" => array(
                    "title" => "Lägg till i 'Mina verktyg'"
                ),
                "unuse" => array(
                    "title" => "Radera från 'Mina verktyg'"
                ),
                "similar_tools" => "Liknande verktyg",
                "share" => "Dela",
                "export" => "Exportera"
            )
        ),

        "popular" => array(
            "heading" => "Mest populära verktyg",
        ),

        "search" => array(
            "form" => array(
                "search" => array(
                    "label" => "Sök",
                    "placeholder" => "Sök"
                )
            ),

            "index" => array(
                "list_more" => "Visa :num till",
            )
        )
    ),

    "users" => array(
        "api_key" => array(
            "heading" => "API-nycklar",
            "api-key" => "Nyckel",
            "created_at" => "Skapad den",
            "description" => "Beskrivning",
            "description-empty" => "Klicka för att lägga till beskrivning",
            "actions" => array(
                "name" => "Handlingar",
                "remove" => array(
                    "title" => "Ta bort API-nyckeln",
                    "confirm" => "Är du säker på att du vill ta bort API-nyckeln?"
                )
            ),
            "apply" => "Ansök om API-nyckel"
        ),

        "form" => array(
            "heading" => "Profile details",
            "name" => array(
                "label" => "Namn",
                "placeholder" => "Namn"
            ),
            "locale" => array(
                "label" => "Språk"
            ),
            "email_address" => array(
                "label" => "E-post address",
                "placeholder" => "E-post"
            ),
            "password" => array(
                "label" => "Nytt lösenord",
                "placeholder" => "Nytt lösenord"
            ),
            "password_confirmation" => array(
                "label" => "Upprepa nytt lösenord",
                "placeholder" => "Upprepa nytt lösenord"
            )
        ),

        "edit" => array(
            "form" => array(
                "submit" => "Uppdatera profil"
            ),
            "heading" => "Editera profil"
        ),

        "tools" => array(
            "heading" => "Mina verktyg",
            "name" => "Mina verktyg",
            "empty" => "Du har inte lagt till några verktyg i listan",
            "actions" => array(
                "name" => "Handlingar",
                "remove" => array(
                    "title" => "Ta bort från listan",
                    "confirm" => "Är du säker på att du vill ta bort verktyget från listan?"
                )
            )
        )
    )
);
