<?php

class BaseHelper
{
    public static function getIpAddress()
    {
        if (!empty(Request::getClientIp())) {
            return Request::getClientIp();
        } else {
            # Otherwise return the IP address of the current server
            return Request::server("SERVER_ADDR");
        }
    }

    public static function getReferer()
    {
        return Request::server("HTTP_REFERER");
    }

    public static function getUserAgent()
    {
        return Request::server("HTTP_USER_AGENT");
    }

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
