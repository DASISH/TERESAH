<?php

class SignupController extends BaseController
{
    protected $skipAuthentication = array("create", "store");
    protected $user;

    public function __construct(Signup $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Show the form for creating a new user.
     *
     * GET /signup
     * 
     * @return View
     */
    public function create()
    {
        return View::make("signup.create")->withUser($this->user);
    }

    /**
     * Store a newly created user in storage.
     *
     * POST /signup
     * 
     * @return Redirect
     */
    public function store()
    {
        $user = $this->user->fill(Input::all());
        $user->active = true;
        $user->user_level = User::AUTHENTICATED_USER;

        if ($user->save()) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("success", Lang::get("controllers/signup.store.success"));
        } else {
            return Redirect::route("signup.create")
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
