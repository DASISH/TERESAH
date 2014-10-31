<?php

class BaseHelper
{
    public static function generateSlug($string, $replace = array("'"), $delimiter = "-")
    {
        setlocale(LC_ALL, "en_US.UTF8");

        if (!empty($replace)) {
            $string = str_replace((array)$replace, " ", $string);
        }

        $slug = iconv("UTF-8", "ASCII//TRANSLIT", $string);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", "", $slug);
        $slug = strtolower(trim($slug, "-"));
        $slug = preg_replace("/[\/_|+ -]+/", $delimiter, $slug);

        return $slug;
    }

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

    public static function isFunctionAvailable($function)
    {
        return (function_exists($function) && !in_array($function, explode(",", ini_get("disabled_functions"))));
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

    public static function secureHash($input, $algorithm = "sha256")
    {
        $salt = Config::get("app.key");

        return hash($algorithm, "{$salt}{$input}".strrev($salt));
    }

    public static function secureRandom($length = 64)
    {
        return str_shuffle(str_random($length));
    }
    
    public static function getContentType($format)
    {
        switch ($format) {
            case "rdfxml":
                return "application/rdf+xml";
                break;
            case "json":
                return "application/json";
                break;
            case "turtle":
                return "text/turtle";
                break;            
            case "svg" :
                return "image/svg+xml";
                break;
            case "png":
                return "image/png";
                break;
            default:
                return "text/plain";
        }
    }
}
