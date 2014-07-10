<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class DataSource extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array(
        "name",
        "description",
        "homepage",
        "user_id"
    );

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "name" => "required|unique:data_sources|max:255",
        "description" => "sometimes|max:1024",
        "homepage" => "sometimes|url",
        "user_id" => "required|integer"
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
}
