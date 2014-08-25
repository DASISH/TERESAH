<?php

class SignupController extends BaseController
{
    protected $skipAuthentication = array("create", "store", "resetPassword", "resetPasswordSendToken", "resetPasswordValidateToken");
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
    
     /**
     * Show the form for request a token for new password
     *
     * GET /reset-password
     * 
     * @return View
     */
    public function resetPassword()
    {
        return View::make("signup.reset");
    }
    
    /**
     * Send an email to user to reset password
     *
     * POST /reset-password
     * 
     * @return Redirect
     */
    public function resetPasswordSendToken()
    {
        $email = Input::get("email_address");
     
        $validator = Validator::make(
            array(
                'email_address' => $email
            ),
            array(               
                'email_address' => 'required|email'
            )
        );
                
        if ($validator->fails()) 
        {
            return Redirect::route("signup.reset")
                ->withErrors($validator->messages())->withInput();            
        
        } else 
        {
            $user = User::getUserByEmail($email);
            
            if($user == null)
            {
                return Redirect::route("signup.reset")
                    ->withErrors(Lang::get("views/signup/reset.email_doesnt_exist"))->withInput();            
            } else {
               
                $token = hash("sha256", Config::get("app.key").$email);
                $url = url("/")."/reset-password/".$user->getAuthIdentifier()."/".$token;
                
                $locale = App::getLocale();

                # TODO: Use queue when sending e-mail messages
                Mail::send("mailers.signup.reset_{$locale}", 
                    array("url" => $url, "user" => $user), function($message) use ($user) {
                    $message->to($user->email_address, $user->name);
                    $message->subject("[TERESAH] ".Lang::get("mailers/signup.reset.subject"));
                });
                
                return Redirect::route("sessions.store")
                    ->with("success", Lang::get("views/signup/reset.email_sent").$user->email_address);
            } 
        }
    }
    
    /**
     * Validate a request to reset password and show form for resetting
     *
     * GET /reset-password/{id}/{token}
     * 
     * @return Redirect
     */
    public function resetPasswordValidateToken($id, $token)
    {
        $user = User::find($id);
        
        if($user == null) {
            return Redirect::route("session.store")
                    ->withErrors(Lang::get("views/signup/reset.invalid_token"));
        } else if(hash("sha256", Config::get("app.key").$user->email_address) != $token) {
            return Redirect::route("session.store")
                    ->withErrors(Lang::get("views/signup/reset.invalid_token"));
        } else {
            Auth::login($user);
            return Redirect::route("signup.resetForm");
        }
    }
    
    /**
     * Show the form for resetting a password.
     *
     * GET /reset-password/update
     * 
     * @return View
     */
    public function resetPasswordForm()
    {
        return View::make("signup.reset_update")->withUser($this->user);
    }
    
    /**
     * Update password for a user
     *
     * PUT/PATCH /reset-password/update
     * 
     * @return Redirect
     */
    public function resetPasswordStore()
    {
        $user = $this->user->fill(Input::all());
        
        if ($user->save()) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("success", Lang::get("views/signup/reset.password_updated"));
        } else {
            return Redirect::route("signup.resetForm")
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
