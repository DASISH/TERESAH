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

Route::group(array("prefix" => "{locale?}", "before" => "setLocale"), function() {

    Route::resource("signup", "SignupController", array(
        "only" => array("index", "store")
    ));

    # Catch all route for the static pages
    Route::get("{path?}", array(
        "as" => "pages.show", 
        "uses" => "PagesController@show"
    ))->where("path", "(.*)?");
});
