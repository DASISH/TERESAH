<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ApiKey extends Eloquent
{
    use SoftDeletingTrait;

    # protected $table = "api_keys";
    protected $dates = array("deleted_at");
    protected $fillable = array("token", "enabled", "description");

    protected $rules = array(
        "token" => "required|unique:api_keys|max:64",
        "enabled" => "required|boolean",
        "description" => "max:255"
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
        if (!isset($value)) {
            $value = self::generateToken();
        }

        return $value;
    }

    public static function generateToken($length = 64)
    {
        # TODO: Should the generated API Key token 
        # be around 16-32 characters long (instead of 64)?
        return mb_strtolower(BaseHelper::secureRandom($length));
    }
}
