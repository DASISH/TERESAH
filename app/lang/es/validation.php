<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => "El :attribute debe ser aceptado.",
    "active_url"           => "El :attribute no es una URL válida.",
    "after"                => "El :attribute debe ser una fecha posterior a :date.",
    "alpha"                => "El :attribute sólo puede contener letras.",
    "alpha_dash"           => "El :attributesólo puede contener letras, números, y guiones.",
    "alpha_num"            => "El :attribute sólo puede contener letras y números.",
    "array"                => "El :attribute debe ser un array.",
    "before"               => "El :attribute debe ser una fecha anterior a :date.",
    "between"              => array(
        "numeric" => "El :attribute debe estar entre :min y :max.",
        "file"    => "El :attribute debe estar entre :min y :max kilobytes.",
        "string"  => "El :attribute debe estar entre :min y :max carácteres.",
        "array"   => "El :attribute debe tener entre :min y :max ítems.",
    ),
    "confirmed"            => "El :attribute de confirmación no coincide.",
    "date"                 => "El :attribute no es una fecha correcta.",
    "date_format"          => "El :attribute no coincide con el formato :format.",
    "different"            => "El :attribute y :other deben ser diferentes.",
    "digits"               => "El :attribute deben ser :digits dígitos.",
    "digits_between"       => "El :attribute debe estar entre :min y :max dígitos.",
    "email"                => "El :attribute debe ser una dirección de correo electrónico válida.",
    "exists"               => "El :attribute elegido no es válido.",
    "image"                => "El :attribute debe ser una imagen.",
    "in"                   => "El :attribute elegido no es válido.",
    "integer"              => "El :attribute debe ser un integer.",
    "ip"                   => "El :attribute debe ser una IP address válida.",
    "max"                  => array(
        "numeric" => "El :attribute no puede ser mayor que :max.",
        "file"    => "El :attribute no puede ser mayor que :max kilobytes.",
        "string"  => "El :attribute no puede ser mayor que :max carácteres.",
        "array"   => "El :attribute may not have more than :max ítems.",
    ),
    "mimes"                => "El :attribute debe ser un archivo de type: :values.",
    "min"                  => array(
        "numeric" => "El :attribute debe ser al menos :min.",
        "file"    => "El :attribute debe ser al menos :min kilobytes.",
        "string"  => "El :attribute debe ser al menos :min carácteres.",
        "array"   => "El :attribute debe tener al menos :min ítems.",
    ),
    "not_in"               => "El :attribute elegido no es válido.",
    "numeric"              => "El :attribute debe ser un número.",
    "regex"                => "El formato del :attribute no es válido.",
    "required"             => "El campo :attribute es obligatorio.",
    "required_if"          => "El campo :attribute es obligatorio cuando :other es :value.",
    "required_with"        => "El campo :attribute es obligatorio cuando :values es present.",
    "required_with_all"    => "El campo :attribute es obligatorio cuando :values es present.",
    "required_without"     => "El campo :attribute es obligatorio cuando :values es not present.",
    "required_without_all" => "El campo :attribute es obligatorio cuando ninguno de los :values están presentes.",
    "same"                 => "El :attribute y :other coincidir.",
    "size"                 => array(
        "numeric" => "El :attribute debe ser :size.",
        "file"    => "El :attribute debe ser :size kilobytes.",
        "string"  => "El :attribute debe ser :size carácteres.",
        "array"   => "El :attribute contener :size ítems.",
    ),
    "unique"               => "El :attribute ya ha sido tomado.",
    "url"                  => "El formato de :attribute no es válido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    "custom" => array(
        "attribute-name" => array(
            "rule-name" => "custom-message",
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | El following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    "attributes" => array_merge(
        Lang::get("models.activity.attributes"),
        Lang::get("models.apikey.attributes"),
        Lang::get("models.data.attributes"),
        Lang::get("models.datasource.attributes"),
        Lang::get("models.datatype.attributes"),
        Lang::get("models.login.attributes"),
        Lang::get("models.tool.attributes"),
        Lang::get("models.user.attributes")
    ),
);

