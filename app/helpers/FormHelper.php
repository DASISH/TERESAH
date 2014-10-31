<?php

use Illuminate\Support\Facades\Form;

class FormHelper
{
    public static function open($model = null, $options = array())
    {
        $supportedMethods = array("patch", "put");

        if (isset($model) && (isset($options["method"]) && in_array($options["method"], $supportedMethods))) {
            return Form::model($model, $options);
        }

        return Form::open($options);
    }
}
