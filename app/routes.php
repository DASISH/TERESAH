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

Route::get("reset-password", array(
    "as" => "signup.reset",
    "uses" => "SignupController@resetPassword"
));

Route::post("reset-password", array(
    "as" => "signup.resetSend",
    "uses" => "SignupController@resetPasswordSendToken"
));

Route::get("reset-password/{id}/{token}", array(
    "as" => "signup.resetValidate",
    "uses" => "SignupController@resetPasswordValidateToken"
));

Route::get("reset-password/update", array(
    "as" => "signup.resetForm",
    "uses" => "SignupController@resetPasswordForm"
));

Route::put("reset-password/update", array(
    "as" => "signup.resetStore",
    "uses" => "SignupController@resetPasswordStore"
));

# Get tool in other formats (eg RDF)
Route::get("tools/{id}.{format}", "ToolsController@export");

#Browse by alphabet
Route::get("tools/by-alphabets/{caracter}", "ToolsController@byAlphabet");

#Quicksearch
Route::get("tools/quicksearch/{query}", "ToolsController@quicksearch");

Route::resource("tools", "ToolsController", array(
    "only" => array("index", "show")
));

# Route grouping for the Tools namespace
Route::group(array("namespace" => "Tools"), function() {
    Route::resource("tools.data-sources", "DataSourcesController", array(
        "only" => array("show")
    ));   
});

# Routing for the administrative section
Route::group(array("prefix" => "admin", "namespace" => "Admin"), function() {
    Route::resource("data-sources", "DataSourcesController");
    Route::resource("tools", "ToolsController");

    # Route grouping for the Admin\Tools namespace
    Route::group(array("namespace" => "Tools"), function() {
        Route::resource("tools.data-sources", "DataSourcesController", array(
            "only" => array("index", "show", "create", "store", "destroy")
        ));

        # Route grouping for the Admin\Tools\DataSources namespace
        Route::group(array("namespace" => "DataSources"), function() {
            Route::resource("tools.data-sources.data", "DataController", array(
                "only" => array("create", "store", "edit", "update", "destroy")
            ));
        });
    });

    Route::resource("users", "UsersController");

    Route::get("/", array(
        "as" => "admin.root",
        "uses" => "ActivitiesController@index"
    ));
});




# Catch all route for the static pages
Route::get("{path?}", array(
    "as" => "pages.show", 
    "uses" => "PagesController@show"
))->where("path", "(.*)?");
