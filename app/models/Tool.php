<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Tool extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array("name", "user_id");

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "name" => "required|unique:tools|max:255",
        "slug" => "required|unique:tools|max:255",
        "user_id" => "required|integer"
    );

    public static function boot()
    {
        self::observe(new ActivityObserver);
        self::observe(new ToolObserver);

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
        return $this->belongsToMany("DataSource", "tool_data_sources")->withTimestamps();
    }

    public function dataTypes()
    {
        return $this->hasManyThrough("DataType", "Data");
    }

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function scopeHaveDataValueLike($query, $value)
    {
        return $query->whereHas("data", function($query) use($value){
            $query->where("value", "like", "%$value%");
        });
    }
    
    public function scopeMatchingString($query, $value)
    {
        return $query->whereHas("data", function($query) use($value){
            $query->where("value", "LIKE", "%$value%");
        })->orWhere("name", "LIKE", "%$value%");
    }    
    
    public function getAbbreviationAttribute()
    {
        return substr(preg_replace("~\b(\w)|.~", "$1", $this->name), 0, 4);
    }
}
