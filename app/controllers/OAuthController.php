<?php

class OAuthController extends BaseController {

    protected $skipAuthentication = array("facebook", "google", "linkedin");
    
    /**
     * Authorizes a user by facebook oauth login
     *
     * GET /login/facebook
     * 
     * @return Redirect
     */
    public function facebook(){
            
        // get data from input
        $code = Input::get( 'code' );

        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );

            $this->validateUser($result["email"], $result["name"], substr($result["locale"], 0, 2));      
            
            return Redirect::intended("/")
            ->with("success", Lang::get("controllers/sessions.store.success"));  
        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
             return Redirect::to( (string)$url );
        }
    }
    
    /**
     * Authorizes a user by google oauth login
     *
     * GET /login/google
     * 
     * @return Redirect
     */
    public function google(){
           
        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

            $this->validateUser($result["email"], $result["name"], $result["locale"]);            
            
            return Redirect::intended("/")
            ->with("success", Lang::get("controllers/sessions.store.success"));  
        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );
        }
    }
    
    /**
     * Authorizes a user by linked in oauth login
     *
     * GET /login/linkedin
     * 
     * @return Redirect
     */
    public function linkedin(){
            
        // get data from input
        $code = Input::get( 'code' );

        $linkedinService = OAuth::consumer( 'Linkedin' );

        if ( !empty( $code ) ) {

            // This was a callback request from linkedin, get the token
            $token = $linkedinService->requestAccessToken( $code );
                        
            // Send a request with it. Please note that XML is the default format.
            $result = json_decode($linkedinService->request('/people/~?format=json'), true);
            $email = json_decode($linkedinService->request('/people/~/email-address?format=json'), true);
            
            $this->validateUser($email, $result["firstName"]." ".$result["lastName"], "en");           

            return Redirect::intended("/")
            ->with("success", Lang::get("controllers/sessions.store.success"));  
            
        }// if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));

            // return to linkedin login url
            return Redirect::to( (string)$url );
        }
    }
    
    /**
     * Checks to see if oauth user has logged in before.
     * If not, creates user.
     * Logs user in.
     * 
     * @return void
     */
    private function validateUser($email, $name, $locale = "en")
    {        
        $user = User::getUserByEmail($email);

        if($user === null)
        {   
            $password = md5(Config::get("app.key").date("Y-m-d H:i:s"));
          
            $user = new User();
            $user->email_address = $email;
            $user->name = $name;
            $user->password = $password;
            $user->password_confirmation = $password;
            $user->active = true;
            $user->user_level = User::AUTHENTICATED_USER;
            $user->locale = $locale;

            if ($user->save()) {
            }
            else{
                return Redirect::route("signup.create")
                    ->withErrors($user->getErrors());
            } 
        }

        Auth::login($user);        
    }
}
