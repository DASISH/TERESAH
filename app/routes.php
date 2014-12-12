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

Route::group(array("prefix" => "api", "namespace" => "Api"), function() {
    Route::group(array("prefix" => "v1", "namespace" => "V1"), function() {
        $namespace = "api.v1";

        # Routing for the application programming interface (API)
        Route::pattern("format", ".(json)");

        # Activities
        Route::get("activities{format}", array("as" => "{$namespace}.activities.index", "uses" => "ActivitiesController@index"));
        Route::get("activities/{id}{format}", array("as" => "{$namespace}.activities.show", "uses" => "ActivitiesController@show"));

        # Data Sources
        Route::get("data-sources{format}", array("as" => "{$namespace}.data-sources.index", "uses" => "DataSourcesController@index"));
        Route::get("data-sources/{id}{format}", array("as" => "{$namespace}.data-sources.show", "uses" => "DataSourcesController@show"));
        Route::post("data-sources{format}", array("as" => "{$namespace}.data-sources.store", "uses" => "DataSourcesController@store"));
        Route::put("data-sources/{id}{format}", array("as" => "{$namespace}.data-sources.update", "uses" => "DataSourcesController@update"));
        Route::patch("data-sources/{id}{format}", array("as" => "{$namespace}.data-sources.update", "uses" => "DataSourcesController@update"));
        Route::delete("data-sources/{id}{format}", array("as" => "{$namespace}.data-sources.destroy", "uses" => "DataSourcesController@destroy"));

        # Data Types
        Route::get("data-types{format}", array("as" => "{$namespace}.data-types.index", "uses" => "DataTypesController@index"));
        Route::get("data-types/{id}{format}", array("as" => "{$namespace}.data-types.show", "uses" => "DataTypesController@show"));
        Route::post("data-types{format}", array("as" => "{$namespace}.data-types.store", "uses" => "DataTypesController@store"));
        Route::put("data-types/{id}{format}", array("as" => "{$namespace}.data-types.update", "uses" => "DataTypesController@update"));
        Route::patch("data-types/{id}{format}", array("as" => "{$namespace}.data-types.update", "uses" => "DataTypesController@update"));
        Route::delete("data-types/{id}{format}", array("as" => "{$namespace}.data-sources.destroy", "uses" => "DataTypesController@destroy"));

        # Logins
        Route::get("logins{format}", array("as" => "{$namespace}.logins.index", "uses" => "LoginsController@index"));
        Route::get("logins/{id}{format}", array("as" => "{$namespace}.logins.show", "uses" => "LoginsController@show"));

        # Tools
        Route::get("tools{format}", array("as" => "{$namespace}.tools.index", "uses" => "ToolsController@index"));
        Route::get("tools/search{format}", array("as" => "{$namespace}.tools.search", "uses" => "ToolsController@search"));
        Route::get("tools/{id}{format}", array("as" => "{$namespace}.tools.show", "uses" => "ToolsController@show"));
        Route::post("tools{format}", array("as" => "{$namespace}.tools.store", "uses" => "ToolsController@store"));
        Route::put("tools/{id}{format}", array("as" => "{$namespace}.tools.update", "uses" => "ToolsController@update"));
        Route::patch("tools/{id}{format}", array("as" => "{$namespace}.tools.update", "uses" => "ToolsController@update"));
        Route::delete("tools/{id}{format}", array("as" => "{$namespace}.tools.destroy", "uses" => "ToolsController@destroy"));

        # Route grouping for the Api\V1\Tools namespace
        Route::group(array("namespace" => "Tools"), function() use($namespace) {
            Route::post("tools/{tools}/data-sources{format}", array("as" => "{$namespace}.tools.data-sources.store", "uses" => "DataSourcesController@store"));
            Route::delete("tools/{tools}/data-sources/{id}{format}", array("as" => "{$namespace}.tools.data-sources.destroy", "uses" => "DataSourcesController@destroy"));

            # Route grouping for the Api\V1\Tools\DataSources namespace
            Route::group(array("namespace" => "DataSources"), function() use($namespace) {
                Route::post("tools/{tools}/data-sources/{data_sources}/data{format}", array("as" => "{$namespace}.tools.data-sources.data.store", "uses" => "DataController@store"));
                Route::put("tools/{tools}/data-sources/{data_sources}/data/{id}{format}", array("as" => "{$namespace}.tools.data-sources.data.update", "uses" => "DataController@update"));
                Route::patch("tools/{tools}/data-sources/{data_sources}/data/{id}{format}", array("as" => "{$namespace}.tools.data-sources.data.update", "uses" => "DataController@update"));
                Route::delete("tools/{tools}/data-sources/{data_sources}/data/{id}{format}", array("as" => "{$namespace}.tools.data-sources.data.destroy", "uses" => "DataController@destroy"));
            });
        });

        # Users
        Route::get("users{format}", array("as" => "{$namespace}.users.index", "uses" => "UsersController@index"));
        Route::get("users/{id}{format}", array("as" => "{$namespace}.users.show", "uses" => "UsersController@show"));
        Route::post("users{format}", array("as" => "{$namespace}.users.store", "uses" => "UsersController@store"));
        Route::put("users/{id}{format}", array("as" => "{$namespace}.users.update", "uses" => "UsersController@update"));
        Route::patch("users/{id}{format}", array("as" => "{$namespace}.users.update", "uses" => "UsersController@update"));
        Route::delete("users/{id}{format}", array("as" => "{$namespace}.users.destroy", "uses" => "UsersController@destroy"));
    });
});

# Routing for the administrative section
Route::group(array("prefix" => "admin", "namespace" => "Admin"), function() {
    Route::resource("api", "ApiKeysController", array(
        "only" => array("index", "create", "store", "edit", "update", "destroy")
    ));

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

# Temporary routes to showcase new user interface:
Route::get("/showcases/login", array(
    "as" => "showcases.login",
    "uses" => "ShowcasesController@login"
));

Route::get("/showcases/signup", array(
    "as" => "showcases.signup",
    "uses" => "ShowcasesController@signup"
));
# End of temporary routes

Route::get("/", array(
    "as" => "pages.root",
    "uses" => "PagesController@index"
));

# Catch all route for the static pages
Route::get("{path?}", array(
    "as" => "pages.show", 
    "uses" => "PagesController@show"
))->where("path", "(.*)?");
