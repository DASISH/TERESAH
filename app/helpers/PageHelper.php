<?php

class PageHelper
{
    public static function getCurrentCommitDate($format = "d.m.Y H:i:s T")
    {
        if (BaseHelper::isFunctionAvailable("exec")) {
            return date($format, strtotime(exec("git log -1 --format=%cD")));
        }

        return Lang::get("views/shared/messages.current_version.commit_date.error");
    }

    public static function getCurrentCommitId()
    {
        if (BaseHelper::isFunctionAvailable("exec")) {
            return exec("git rev-parse --short HEAD");
        }

        return Lang::get("views/shared/messages.current_version.commit_id.error");
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
