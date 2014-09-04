<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class User extends Eloquent implements UserInterface
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    # Default user levels
    const AUTHENTICATED_USER = 1;
    const COLLABORATOR = 2;
    const SUPERVISOR = 3;
    const ADMINISTRATOR = 4;

    protected $dates = array("deleted_at");
    protected $fillable = array(
        "email_address",
        "password",
        "password_confirmation",
        "name",
        "locale"
    );
    protected $hidden = array(
        "password",
        "password_confirmation",
        "active",
        "user_level"
    );

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "email_address" => "required|unique:users|email|max:255",
        "password" => "required|confirmed|min:8",
        "password_confirmation" => "required|min:8",
        "name" => "required|max:255",
        # "locale": validation rule specified in boot()
        "active" => "required|boolean",
        "user_level" => "required|in:1,2,3,4"
    );

    public static function boot()
    {
        self::observe(new ActivityObserver);
        self::observe(new UserObserver);

        static::saving(function($model) {
            # Due the dynamic nature of the available locales,
            # we need to setup the validation rule for locale 
            # attribute in boot sequence of the model.
            $model->rules["locale"] = "sometimes|in:".implode(
                ",", Config::get("app.available_locales")
            );

            if (!empty($model->getOriginal("password")) 
                && $model->password == $model->getOriginal("password")) {
                $model->disablePasswordValidation();
            }

            if ($model->isValid()) {
                $model->hashPassword();
                $model->disablePasswordValidation();
                $model->purgeRedundantAttributes();
            }
        });

        parent::boot();
    }

    public function activity()
    {
        return $this->morphMany("Activity", "target");
    }

    public function activities()
    {
        return $this->hasMany("Activity");
    }

    public function data()
    {
        return $this->hasMany("Data");
    }

    public function dataSources()
    {
        return $this->hasMany("DataSource");
    }

    public function dataTypes()
    {
        return $this->hasMany("DataType");
    }

    public function logins()
    {
        return $this->hasMany("Login");
    }

    public function apiKeys()
    {
        return $this->hasMany("ApiKey");
    }

    public function tools()
    {
        return $this->hasMany("Tool");
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Try to get the first name of the user.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        $name = explode(" ", $this->name, 2);

        return $name[0];
    }

    /**
     * Try to get the last name of the user.
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        $name = explode(" ", $this->name, 2);

        return $name[1];
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "remember_token";
    }

    /**
     * Get the token value for password reset.
     *
     * @return string
     */
    public function getPasswordResetToken()
    {
        return $this->password_reset_token;
    }

    /**
     * Set the token value for password reset.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordResetToken($value)
    {
        $this->password_reset_token = $value;
    }
    
    /**
     * Get the token value for password reset.
     *
     * @return string
     */
    public function getPasswordResetSentAt()
    {
        return $this->password_reset_token;
    }

    /**
     * Set the token value for password reset.
     *
     * @param  timestamp  $value
     * @return void
     */
    public function setPasswordResetSentAt($value)
    {
        $this->password_reset_sent_at = $value;
    }
    
    /**
     * Check if the user is an authenticated user.
     *
     * @return boolean
     */
    public function isAuthenticatedUser()
    {
        return $this->user_level == self::AUTHENTICATED_USER;
    }

    /**
     * Check if the user is a collaborator.
     *
     * @return boolean
     */
    public function isCollaborator()
    {
        return $this->user_level == self::COLLABORATOR;
    }

    /**
     * Check if the user is a supervisor.
     *
     * @return boolean
     */
    public function isSupervisor()
    {
        return $this->user_level == self::SUPERVISOR;
    }

    /**
     * Check if the user is an administrator.
     *
     * @return boolean
     */
    public function isAdministrator()
    {
        return $this->user_level == self::ADMINISTRATOR;
    }

    public function userLevelName()
    {
        switch ($this->user_level) {
            case $this->isAuthenticatedUser():
                return "authenticated_user";
                break;

            case $this->isCollaborator():
                return "collaborator";
                break;

            case $this->isSupervisor():
                return "supervisor";
                break;

            case $this->isAdministrator():
                return "administrator";
                break;
        }
    }

    /**
     * Disables the validation rules for password and 
     * password confirmation. Used mainly when updating
     * the user record.
     *
     * @return void
     */
    public function disablePasswordValidation()
    {
        unset($this->rules["password"]);
        unset($this->rules["password_confirmation"]);
    }

    /**
     * Hash the password for the user using the Bcrypt algorithm.
     *
     * @return void
     */
    private function hashPassword()
    {
        if (isset($this->password) && $this->password != $this->getOriginal("password")) {
            $this->password = Hash::make($this->password);
        }
    }

    /**
     * Purge redundant input data (password confirmation) 
     * from the model, in order to prevent the reduntant data 
     * being saved to database.
     *
     * @return void
     */
    private function purgeRedundantAttributes()
    {
        if (isset($this->password_confirmation)) {
            unset($this->password_confirmation);
        }
    }
    
    public static function getUserByEmail($email_address)
    {
        $users = User::where("email_address", "=", $email_address)->take(1)->get();
        if(count($users) == 0)
        {
            return null;
        } else {
            return $users[0];
        }
    }
    
    public static function getUserByResetToken($token)
    {
        $users = User::where("password_reset_token", "=", $token)->take(1)->get();
        if(count($users) == 0) {
            return null;
        } else if(time() - strtotime($users[0]->password_reset_sent_at) > 604800) {
            return null; //Check so token is not older than a week 
        } else {            
            return $users[0];
        }
    }
}
