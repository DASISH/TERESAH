<?php

return array(
    "admin" => array(
        "authorize" => array(
            "warning" => "Ogiltig begäran. Du har otillräckliga behörigheter för att komma åt den adminstrative sektionen av TERESAH."
        ),

        "data_sources" => array(
            "store" => array(
                "success" => "Informationskällan skapades."
            ),
            "update" => array(
                "success" => "Informationskällan uppdaterades."
            ),
            "destroy" => array(
                "error" => "Ett fel uppstod när informationskällan skulle raderas. Var vänlig försök igen senare.",
                "success" => "Informationskällan raderades."
            )
        ),

        "data_types" => array(
            "store" => array(
                "success" => "Datatypen skapades."
            ),
            "update" => array(
                "success" => "Datatypen uppdaterades."
            ),
            "destroy" => array(
                "error" => "Ett fel uppstod när datatypen skulle raderas. Var vänlig försök igen senare.",
                "success" => "Datatypen raderades."
            )
        ),

        "tools" => array(
            "store" => array(
                "success" => "Verktyget skapades."
            ),
            "update" => array(
                "success" => "Verktyget uppdaterades."
            ),
            "destroy" => array(
                "error" => "Ett fel uppstod när verktyget skulle raderas. Var vänlig försök igen senare.",
                "success" => "Verktyget raderades."
            ),

            "data_sources" => array(
                "store" => array(
                    "error" => "Ett fel uppstod när informationskällan skulle kopplas till verktyget. Var vänlig försök igen senare.",
                    "success" => "Informationskällan kopplades till verktyget."
                ),
                "destroy" => array(
                    "error" => "Ett fel uppstod när informationskällan skulle frånkopplas från verktyget. Var vänlig försök igen senare.",
                    "success" => "Informationskällan frånkopplades från verktyget."
                ),

                "data" => array(
                    "store" => array(
                        "success" => "Informationsposten skapad för informationskällan"
                    ),
                    "update" => array(
                        "success" => "Informationsposten uppdaterad för informationskällan"
                    ),
                    "destroy" => array(
                        "error" => "Ett fel uppstod när informationsposten skulle raderas från informationskällan. Var vänlig försök igen senare.",
                        "success" => "Informationsposten raderades från informationskällan."
                    )
                )
            )
        ),

        "users" => array(
            "store" => array(
                "success" => "Användarkonto skapat."
            ),
            "update" => array(
                "success" => "Användarkonto uppdaterat."
            ),
            "destroy" => array(
                "error" => "Ett fel uppstod när användarkontot skulle raderas. Var vänlig försök igen senare.",
                "success" => "Användarkontot är raderat."
            )
        )
    ),

    "api_key" => array(
        "apply" => array(
        "success" => "En ansökan om ny API-nyckel har skapats. En administratör behöver godkänna din ansökan innan nyckeln kan användas.",
            "error" => "Ett fel uppstod när din ansökan skickades. Var vänlig försök igen senare. Om felet kvarstår, kontakta en administratör.",
            "application_exist" => "Du har redan skickat en ansökan om en ny API-nyckel."
        ),
        "destroy" => array(
            "success" => "API-nyckeln har raderats.",
            "error" => "Ett fel uppstod när API-nyckeln skulle raderas. Var vänlig försök igen senare. Om felet kvarstår, kontakta en administratör."
        )
    ),

    "sessions" => array(
        "auth" => array(
            "info" => "Otillåten begäran, var vänlig logga in."
        ),
        "store" => array(
            "error" => "Felaktig epostadress eller lösenord. Var vänlig försök igen (var säker på att caps lock är av)",
            "success" => "Du är nu inloggad.",
            "blocked" => "Otillåten begäran. Användarkontot har spärrats."
        ),
        "destroy" => array(
            "success" => "Du är nu utloggad."
        )
    ),

    "signup" => array(
        "store" => array(
            "success" => "Användarkonto har skapats."
        )
    ),

    "tools" => array(
        "show" => array(
            "no_data_sources_available" => "Tyvärr har inte det begärda verktyget några informationskällor tillgängliga. Var vänlig försök igen senare."
        )
    ),

    "users" => array(
        "update" => array(
            "success" => "Användarprofilen uppdaterades."
        )
    ),
    
    "license" => array(
        "source" => "Licens för källkod",
        "content" => "Licens för innehåll"
    ),
    
    "help" => "Hjälp",
);
