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
        self::observe(new DataSourceObserver);
        
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

    public function getLatestToolDataFor($toolId, $column = "name")
    {
        return $this->data()->join("data_types", "data_types.id", "=", "data.data_type_id")
            ->where("data.tool_id", "=", $toolId)
            ->where("data_types.slug", "=", $column)
            ->whereNull("data_types.deleted_at")
            ->orderBy("data.updated_at", "DESC")
            ->pluck("value");
    }
    
    public function scopeHaveData($query)
    {
        return $query->has("data", ">", 0);
    }     
}
