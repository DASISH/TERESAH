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
    
    public static function renderAdmin($breadcrumb = array())
    {
        $home = array(link_to_route("admin.root", 
            Lang::get("views/pages/navigation.admin.home.name"), 
            array(),
            array("title" => Lang::get("views/pages/navigation.admin.home.title"))
        ));
        $breadcrumb = array_merge($home, $breadcrumb);

        return View::make("shared._breadcrumb", compact("breadcrumb"))->render();
    }
}
