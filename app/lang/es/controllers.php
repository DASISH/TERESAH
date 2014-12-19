<?php

return array(
    "admin" => array(
        "authorize" => array(
            "warning" => "Petición no autorizada. Insuficientes permisos para acceder a la sección administrativa de TERESAH."
        ),

        "api_keys" => array(
            "store" => array(
                "success" => "La API Key se ha creado con éxito."
            ),
            "update" => array(
                "success" => "La API Key se ha actualizado con éxito."
            ),
            "destroy" => array(
                "error" => "Se ha producido un error al eliminar la API Key requerida. Por favor, inténtelo más tarde.",
                "success" => "La API Key se ha eliminado con éxito."
            )
        ),

        "data_sources" => array(
            "store" => array(
                "success" => "La Fuente de Datos se ha registrado con éxito."
            ),
            "update" => array(
                "success" => "La Fuente de Datos se ha actualizado con éxito."
            ),
            "destroy" => array(
                "error" => "Se ha producido un error al eliminar la Fuente de Datos requerida. Por favor, inténtelo más tarde.",
                "success" => "La Fuente de Datos se ha eliminado con éxito."
            )
        ),

        "data_types" => array(
            "store" => array(
                "success" => "El Data Type se ha registrado en éxito."
            ),
            "update" => array(
                "success" => "El Data Type se ha actualizado en éxito."
            ),
            "destroy" => array(
                "error" => "Se ha producido un error al eliminar el Data Type requerida. Por favor, inténtelo más tarde.",
                "success" => "El Data Type se ha eliminado en éxito."
            )
        ),

        "tools" => array(
            "store" => array(
                "success" => "La Herramienta se ha creado con éxito."
            ),
            "update" => array(
                "success" => "La Herramienta se ha registrado con éxito."
            ),
            "destroy" => array(
                "error" => "Se ha producido un error al eliminar la Herramienta requerida. Por favor, inténtelo más tarde.",
                "success" => "La Herramienta se ha eliminado con éxito."
            ),

            "data_sources" => array(
                "store" => array(
                    "error" => "Se ha producido un error al vincular la Fente de Datos requerida la Herramienta. Por favor, inténtelo más tarde.",
                    "success" => "La Funte de Datos se ha vinculado a la Herramienta con éxito."
                ),
                "destroy" => array(
                    "error" => "Se ha producido un error al desvincular la Fente de Datos requerida la Herramienta. Por favor, inténtelo más tarde.",
                    "success" => "La Fuente de Datos se ha desvinculado con éxito."
                ),

                "data" => array(
                    "store" => array(
                        "success" => "La entrada para la Fuente de Datos se ha creado con éxito."
                    ),
                    "update" => array(
                        "success" => "La entrada para la Fuente de Datos se ha actualizado con éxito."
                    ),
                    "destroy" => array(
                        "error" => "Se ha producido un error al eliminar la entrada para la Fuente de Datos. Por favor, inténtelo más tarde.",
                        "success" => "La entrada se ha eliminado de la Fente de Datos con éxito."
                    )
                )
            )
        ),

        "users" => array(
            "store" => array(
                "success" => "La Cuenta de Usuario se ha creado con éxito."
            ),
            "update" => array(
                "success" => "La Cuenta de Usuario se ha actualizado con éxito."
            ),
            "destroy" => array(
                "error" => "Se ha producido un error al eliminar la Cuenta de Usuario. Por favor, inténtelo más tarde.",
                "success" => "La Cuenta de Usuario se ha eliminado con éxito."
            )
        )
    ),

    "api" => array(
        "insufficient_privileges" => "Permisos insuficientes. Acceso prohibido.",
        "invalid_content_type_header" => "Content-Type inválido. Por favor, asegúrese de mandar las peticiones con Content-Type: application/json; charset=utf-8.",
        "invalid_user_agent_header" => "User-Agent in correcto. Por favor, asegúrese de que su petición tenga el User-Agent header apropiado.",
        "rate_limit_exceeded" => "Se ha excediso el límite de la API por IP address :ip_address.",
        "unauthorized_request" => "Petición no autorizada. Por favor, please autentifique su petició."
    ),

    "api_key" => array(
        "apply" => array(
            "success" => "La solicitud para la API Key se ha creado con éxito. Se necesita la aprobación de un Administrador antes de poder usar la API key.",
            "error" => "Se ha producido un error al enviar la solicitud. Por favor, inténtelo más tarde. Si el error persiste contacte con el administrador.",
            "application_exist" => "Usted ya ha enviado una solicitud para una API key."
        ),
        "destroy" => array(
            "success" => "La API key se ha eliminado con éxito.",
            "error" => "Se ha producido un error al eliminar la API key. Por favor, inténtelo más tarde. Si el error persiste contacte con el administrador."
        )
    ),

    "sessions" => array(
        "auth" => array(
            "info" => "Petición no autorizada. Por favor, inicie la sesión."
        ),
        "store" => array(
            "error" => "Correo o contraseña incorrectos. Por favor, inténtelo de nuevo (asegúrese de que su cap locks no esté activado).",
            "success" => "Sesión iniciada con éxito.",
            "blocked" => "Acceso no sutorizado. El usuario está bloqueado."
        ),
        "destroy" => array(
            "success" => "Sesión finalizada."
        )
    ),

    "signup" => array(
        "store" => array(
            "success" => "La Cuenta de Usuario se ha creado con éxito."
        )
    ),

    "tools" => array(
        "show" => array(
            "no_data_sources_available" => "La Herramienta requerida no tiene ninguna Fuente de Datos disponible. Por favor, inténtelo más tarde."
        )
    ),

    "users" => array(
        "update" => array(
            "success" => "El Perfil se ha actualizado con éxito."
        )
    ),

    "license" => array(
        "source" => "Licencia para el código fuente",
        "content" => "Licencia para el contenido"
    ),
    
    "help" => "Help",
);
