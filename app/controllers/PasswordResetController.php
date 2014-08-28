<?php

class PasswordResetController extends BaseController {

    protected $skipAuthentication = array("request", "send", "validate");
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }    

    /**
     * Show the form for request a token for new password
     *
     * GET /request-password
     * 
     * @return View
     */
    public function request()
    {
        return View::make("password-reset.request");
    }

    /**
     * Send an email to user to reset password
     *
     * POST /request-password
     * 
     * @return Redirect
     */
    public function send()
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
            return Redirect::route("request-password.request")
                ->withErrors($validator->messages())->withInput();            
        
        } else 
        {
            $user = User::getUserByEmail($email);
            
            if($user == null)
            {
                return Redirect::route("sessions.store")
                    ->with("success", Lang::get("views/password-reset/reset.email_sent").$email);        
            } else {
               
                $token = hash("sha256", Config::get("app.key").$email);
                $url = url("/")."/request-password/".$user->getAuthIdentifier()."/".$token;
                
                $locale = App::getLocale();

                # TODO: Use queue when sending e-mail messages
                Mail::send("mailers.password-reset.request_{$locale}", 
                    array("url" => $url, "user" => $user), function($message) use ($user) {
                    $message->to($user->email_address, $user->name);
                    $message->subject("[TERESAH] ".Lang::get("mailers/password-reset.request.subject"));
                });
                
                return Redirect::route("sessions.store")
                    ->with("success", Lang::get("views/password-reset/request.email_sent").$email);
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
    public function validate($id, $token)
    {
        $user = User::find($id);
        
        if($user == null) {
            return Redirect::route("sessions.store")
                    ->withErrors(Lang::get("views/password-reset/reset.invalid_token"));
        } else if(hash("sha256", Config::get("app.key").$user->email_address) != $token) {
            return Redirect::route("sessions.store")
                    ->withErrors(Lang::get("views/password-reset/reset.invalid_token"));
        } else {
            Auth::login($user);
            return Redirect::route("reset-password.reset");
        }
    }

    /**
     * Show the form for resetting a password.
     *
     * GET /reset-password
     * 
     * @return View
     */
    public function reset()
    {
        return View::make("password-reset.reset")->withUser($this->user);
    }

    /**
     * Update password for a user
     *
     * PUT/PATCH /reset-password
     * 
     * @return Redirect
     */
    public function update()
    {
        $user = $this->user->fill(Input::all());
        
        if ($user->save()) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("success", Lang::get("views/password-reset/reset.password_updated"));
        } else {
            return Redirect::route("reset-password.reset")
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
