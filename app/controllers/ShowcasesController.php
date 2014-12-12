<?php

# TODO: Remove the ShowcasesController after the implementation of
# the new user interface to actual workflows is done.

class ShowcasesController extends BaseController
{
    protected $layout = "layouts.dialog";
    protected $skipAuthentication = array("login", "signup");

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the static login page in new user interface.
     *
     * GET /showcases/login
     *
     * @return View
     */
    public function login()
    {
        return View::make("showcases.login");
    }

    /**
     * Display the static sign up page in new user interface.
     *
     * GET /showcases/signup
     *
     * @return View
     */
    public function signup()
    {
        return View::make("showcases.signup");
    }
}
