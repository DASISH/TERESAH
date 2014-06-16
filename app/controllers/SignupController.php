<?php

class SignupController extends BaseController
{
    protected $skipAuthentication = array("index", "store");
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Show the form for creating a new user.
     *
     * /{locale}/signup
     * 
     * @return Response
     */
    public function index()
    {
        return View::make("signup.index")->withUser($this->user);
    }

    /**
     * Store a newly created user in storage.
     *
     * /{locale}/signup
     * 
     * @return Response
     */
    public function store()
    {
        $user = $this->user->fill(Input::all());

        if ($user->save()) {
            return Redirect::route("pages.show", array("locale" => App::getLocale(), "path" => "/"))
                ->with("success", Lang::get("controllers/signup.store.success"));
        } else {
            return Redirect::route("{locale?}.signup.index", array("locale" => App::getLocale()))
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
