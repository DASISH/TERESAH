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

    public function data()
    {
        return $this->hasMany("Data");
    }

    public function tools()
    {
        return $this->belongsToMany("Tool", "tool_data_sources")->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function getDataValue($key, $toolId)
    {
        $data = $this->data()->where("tool_id", $toolId)->lists("value", "key");

        # TODO: Add case-insensitive search for the array key
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }

    /**
     * Returns "nicely" formatted version of the homepage 
     * address.
     *
     * @return string
     */
    public function getSourceAttribute()
    {
        return parse_url($this->homepage)["host"];
    }
}
