<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class ApiKey extends BaseModel
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array("user_id", "token", "enabled", "description");

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "user_id" => "required|integer|exists:users,id,deleted_at,NULL",
        "token" => "required|unique:api_keys|alpha_dash|min:16|max:64",
        "enabled" => "required|boolean",
        "description" => "sometimes|max:255"
    );

    public static function boot()
    {
        self::observe(new ActivityObserver);

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

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function getTokenAttribute($value)
    {
        if ((!isset($value) && empty($value)) && !$this->isDirty("token")) {
            return self::generateToken();
        }

        return $value;
    }

    public static function generateToken($length = 32)
    {
        return mb_strtolower(BaseHelper::secureRandom($length));
    }
}
