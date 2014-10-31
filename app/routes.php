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

Route::get("profile/api-keys", array(
    "as" => "users.keys",
    "uses" => "UsersController@keys"
));

Route::get("profile/my-tools", array(
    "as" => "users.tools",
    "uses" => "UsersController@tools"
));

Route::resource("api-key", "ApiKeyController", array(
    "only" => array("create", "update", "destroy")
));

Route::get("signup", array(
    "as" => "signup.create",
    "uses" => "SignupController@create"
));

Route::resource("signup", "SignupController", array(
    "only" => array("store")
));

Route::get("request-password", array(
    "as" => "request-password.request",
    "uses" => "PasswordResetController@request"
));

Route::post("request-password", array(
    "as" => "request-password.send",
    "uses" => "PasswordResetController@send"
));

Route::get("request-password/{token}", array(
    "as" => "request-password.validate",
    "uses" => "PasswordResetController@validate"
));

Route::get("reset-password", array(
    "as" => "reset-password.reset",
    "uses" => "PasswordResetController@reset"
));

Route::put("reset-password", array(
    "as" => "reset-password.update",
    "uses" => "PasswordResetController@update"
));

# Get tool in other formats (eg RDF)
Route::get("tools/{id}.{format}", array(
    "as" => "tools.export",
    "uses" => "RdfController@tool"
));

Route::get("rdf/datatypes.{format}", array(
    "uses" => "RdfController@datatypes"
));

Route::get("rdf/tools.{format}", array(
    "uses" => "RdfController@tools"
));

Route::get("rdf/datasources.{format}", array(
    "uses" => "RdfController@datasources"
));

#Browse by alphabet
Route::get("tools/by-alphabets/{caracter}", "ToolsController@byAlphabet");

#Browse facet
Route::get("tools/by-facet", array( 
    "as" => "by-facet",
    "uses" => "DataTypeController@index"
));

#Browse facet values
Route::get("tools/by-facet/{facet}", array(
    "as" => "data.by-type",
    "uses" => "DataController@valuesByType"
));

#Browse by facet
Route::get("tools/by-facet/{facet}/{value}", array(
    "as" => "tools.by-facet",
    "uses" => "ToolsController@byFacet"
));

#Tool usage
Route::get("tools/popular", array(
    "as" => "tools.popular",
    "uses" => "ToolUsageController@index"
));
Route::get("tools/use/{toolID}", array(
    "as" => "tools.use",
    "uses" => "ToolUsageController@create"
));
Route::delete("tools/use/{toolID}", array(
    "as" => "tools.unuse",
    "uses" => "ToolUsageController@destroy"
));

Route::get("datacloud.json", "DataController@dataCloud");

#Quicksearch
Route::get("tools/quicksearch/{query}", "ToolsController@quicksearch");
Route::get("data/quicksearch/{query}", "DataController@quicksearch");

#Search
Route::get("search", array(
    "as" => "tools.search",
    "uses" => "ToolsController@search"
));

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
    Route::resource("data-types", "DataTypesController");
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
    Route::resource("activities", "ActivitiesController");
    Route::resource("harvest", "HarvestController");

    Route::get("/", array(
        "as" => "admin.root",
        "uses" => "ToolsController@index"
    ));
});

#Routing for OAuth Login
Route::get("login/facebook", array(
    "as" => "login.facebook",
    "uses" => "OAuthController@facebook"
));

Route::get("login/google", array(
    "as" => "login.google",
    "uses" => "OAuthController@google"
));

Route::get("login/linkedin", array(
    "as" => "login.linkedin",
    "uses" => "OAuthController@linkedin"
));

# Catch all route for the static pages
Route::get("{path?}", array(
    "as" => "pages.show", 
    "uses" => "PagesController@show"
))->where("path", "(.*)?");
