<?php

class SessionsController extends BaseController
{
    protected $skipAuthentication = array("create", "store", "destroy", "dialog");
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Show the form for creating a new session.
     *
     * GET /login
     *
     * @return View
     */
    public function create()
    {
        Session::put("previous_url", URL::previous());
        return View::make("users.login");
    }
    
    /**
     * Show the form for creating a new session.
     *
     * GET /login
     *
     * @return View
     */
    public function dialog()
    {
        Session::put("previous_url", URL::previous());
        return View::make("users.login_dialog");
    }
    

    /**
     * Create/store a new session for the user.
     *
     * POST /login
     *
     * @return Redirect
     */
    public function store()
    {
        $credentials = array(
            "email_address" => Input::get("email_address"),
            "password" => Input::get("password"),
            "active" => true
        );

        # Try to authenticate the user and "remember" the login
        # if the authentication succeeds.
        if (Auth::attempt($credentials, true)) {
            Login::log(Auth::user(), Auth::viaRemember());

            Session::put("locale", Auth::user()->locale);
            App::setLocale(Auth::user()->locale);

            if(Session::get("previous_url") !== null){
                return Redirect::intended(SESSION::pull("previous_url"))
                    ->with("success", Lang::get("controllers.sessions.store.success"));
            }
            else{
                return Redirect::intended("/")
                    ->with("success", Lang::get("controllers.sessions.store.success"));
            }
        }
        else #check if user is blocked
        {
            $user = User::getUserByEmail(Input::get("email_address"));

            if($user != null){
                if(!$user->active)
                {
                    return Redirect::route("sessions.create")
                        ->withErrors(array(Lang::get("controllers.sessions.store.blocked")))
                        ->with("simple_error_message", true)->withInput();
                }
            }
        }

        return Redirect::route("sessions.create")
            ->withErrors(array(Lang::get("controllers.sessions.store.error")))
            ->with("simple_error_message", true)->withInput();
    }

    /**
     * Destroy the current session and redirect to "home".
     *
     * GET /logout
     *
     * @return Redirect
     */
    public function destroy()
    {
        Auth::logout();

        Session::forget("locale");

        return Redirect::to(URL::previous())
            ->with("success", Lang::get("controllers.sessions.destroy.success"));
    }
}
