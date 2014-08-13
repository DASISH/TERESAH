<?php

class PageHelper
{
    public static function getCurrentCommitId()
    {
        if (!in_array("exec", explode(",", ini_get("disabled_functions")))) {
            return exec("git rev-parse --short HEAD");
        }

        return Lang::get("views/shared/messages.current_version.error");
    }

    public static function robotsMetaTag()
    {
        switch (App::environment()) {
            case "production":
                $content = "index, follow";
                break;

            default:
                $content = "noindex, nofollow";
                break;
        }

        return "<meta name=\"robots\" content=\"{$content}\" />\n";
    }

    public static function showVersionInformation()
    {
        switch (App::environment()) {
            case "development":
            case "staging":
            case "test":
                return true;
                break;

            default:
                return false;
                break;
        }
    }    
}
