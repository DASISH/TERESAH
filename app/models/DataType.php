<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class DataType extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array(
        "user_id",
        "label",
        "description",
        "rdf_mapping",
        "linkable"
    );

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "user_id" => "required|integer",
        "label" => "required|unique:data_types|max:255",
        "slug" => "required|unique:data_types|max:255",
        "description" => "sometimes|max:1024",
        "rdf_mapping" => "sometimes|url|max:255",
        "linkable" => "sometimes|boolean"
    );

    public static function boot()
    {
        self::observe(new ActivityObserver);
        self::observe(new DataTypeObserver);

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

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function scopeIsLinkable($query)
    {
        return $query->where("linkable", true);
    }    
    
    /**
     * Normalize the data type label.
     *
     * For example label named "keywords" will be converted to
     * "Keywords" and "last modified" to "Last Modified".
     *
     * @param  string  $value
     * @return void
     */
    public function setLabelAttribute($value)
    {
        $this->attributes["label"] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }
}
