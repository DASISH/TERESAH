<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get("login", array(
    "as" => "sessions.create",
    "uses" => "SessionsController@create"
));

Route::post("login", array(
    "as" => "sessions.store",
    "uses" => "SessionsController@store"
));

Route::get("logout", array(
    "as" => "sessions.destroy",
    "uses" => "SessionsController@destroy"
));

Route::get("profile", array(
    "as" => "users.edit",
    "uses" => "UsersController@edit"
));

Route::put("profile", array(
    "as" => "users.update",
    "uses" => "UsersController@update"
));

Route::get("signup", array(
    "as" => "signup.create",
    "uses" => "SignupController@create"
));

Route::resource("signup", "SignupController", array(
    "only" => array("store")
));

# Routing for the administrative section
Route::group(array("prefix" => "admin"), function() {
    Route::get("data-sources/{id}/delete", array(
        "as" => "admin.data-sources.delete",
        "uses" => "Admin\DataSourcesController@delete"
    ));

    Route::resource("data-sources", "Admin\DataSourcesController", array(
        "only" => array(
            "index", "show", "create", "store",
            "edit", "update", "destroy"
        )
    ));

    Route::get("tools/{id}/delete", array(
        "as" => "admin.tools.delete",
        "uses" => "Admin\ToolsController@delete"
    ));

    Route::resource("tools", "Admin\ToolsController", array(
        "only" => array(
            "index", "show", "create", "store",
            "edit", "update", "destroy"
        )
    ));

    Route::get("users/{id}/delete", array(
        "as" => "admin.users.delete",
        "uses" => "Admin\UsersController@delete"
    ));

    Route::resource("users", "Admin\UsersController", array(
        "only" => array(
            "index", "show", "create", "store",
            "edit", "update", "destroy"
        )
    ));

    Route::get("/", array(
        "as" => "admin.root",
        "uses" => "Admin\ActivitiesController@index"
    ));
});

# Catch all route for the static pages
Route::get("{path?}", array(
    "as" => "pages.show", 
    "uses" => "PagesController@show"
))->where("path", "(.*)?");
