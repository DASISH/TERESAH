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
        "name" => "required|max:255"
        # "locale": validation rule specified in boot()
    );

    # Add unique identifier to the rules when performing 
    # validation. Otherwise if the model already exists 
    # and it has unique validations, it is going to fail
    # the validation.
    protected $injectUniqueIdentifier = true;

    public static function boot()
    {
        parent::boot();

        self::observe(new ActivityObserver);
        self::observe(new UserObserver);

        # FIXME/TODO: The public static "bootValidatingTrait()" function
        # in the Validating trait (Watson/Validating/ValidatingTrait.php) 
        # doesn't seem to work at the moment. Using the following
        # "workaround" in order to use the ValidatingObserver.
        # 
        self::observe(new ValidatingObserver);
        # End of the "workaround"

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
                $model->purgeRedundantAttributes();

                return true;
            } else {
                return false;
            }
        });
    }

    public function activity()
    {
        return $this->morphMany("Activity", "target");
    }

    public function activities()
    {
        return $this->hasMany("Activity");
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
    public function getFirstName()
    {
        $name = explode(" ", $this->name, 2);

        return $name[0];
    }

    /**
     * Try to get the last name of the user.
     *
     * @return string
     */
    public function getLastName()
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
     * Disables the validation rules for password and 
     * password confirmation. Used mainly when updating
     * the user record.
     *
     * @return void
     */
    private function disablePasswordValidation()
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
}
