<?php

class BaseHelper
{
    public static function mapAvailableLocalesForSelect()
    {
        $availableLocales = array(
            "select" => "--- ".Lang::get("views/shared/form.select_locale")." ---"
        );

        foreach (Config::get("app.available_locales") as $locale) {
            $availableLocales[$locale] = Lang::get("views/shared/locales.{$locale}");
        }

        return $availableLocales;
    }
}
