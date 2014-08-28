<?php

class PasswordResetController extends BaseController {

    protected $skipAuthentication = array("request", "send", "validate");
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = Auth::user();
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
               
                $current_time = date("Y-m-d H:i:s");
                $token = hash("sha256", Config::get("app.key").$email.$current_time);
                $url = url("/")."/request-password/".$token;
                
                //Save token to database
                $user->password_reset_token = $token;
                $user->password_reset_sent_at = $current_time;   
                $user->save();
                
                $locale = App::getLocale();

                # TODO: Use queue when sending e-mail messages
                Mail::send(array("text"=> "mailers.password-reset.request_{$locale}"), 
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
     * GET /reset-password/{token}
     * 
     * @return Redirect
     */
    public function validate($token)
    {
        $user = User::getUserByResetToken($token);
        
        if($user == null) {
            return Redirect::route("sessions.store")
                    ->withErrors(Lang::get("views/password-reset/reset.invalid_token"));        
        } else {
            
            //Remove token from database
            $user->password_reset_token = null;
            $user->password_reset_sent_at = null;   
            $user->save();
            
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

        $user = $this->user->fill(Input::only("password", "password_confirmation"));
                
        if ($user->save()) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("success", Lang::get("views/password-reset/reset.password_updated"));
        } else {
            return Redirect::route("reset-password.reset")
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
