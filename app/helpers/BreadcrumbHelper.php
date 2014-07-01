<?php

/**
 * TODO: Refactor the BreadcrumbHelper to it's own "library".
 */
class BreadcrumbHelper
{
    public static function render($breadcrumb = array())
    {
        $home = array(link_to_route("pages.show", 
            Lang::get("views/pages/navigation.home.name"), 
            array("path" => "/"),
            array("title" => Lang::get("views/pages/navigation.home.title"))
        ));
        $breadcrumb = array_merge($home, $breadcrumb);

        return View::make("shared._breadcrumb", compact("breadcrumb"))->render();
    }
}
