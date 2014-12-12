<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Data extends BaseModel
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array("data_type_id", "user_id", "tool_id", "data_source_id", "value");

    /**
     * Validation rules for the model
     */
    protected $rules = array(
        "data_source_id" => "required|integer|exists:data_sources,id,deleted_at,NULL",
        "tool_id" => "required|integer|exists:tools,id,deleted_at,NULL",
        "user_id" => "required|integer|exists:users,id,deleted_at,NULL",
        "data_type_id" => "required|integer|exists:data_types,id,deleted_at,NULL",
        "slug" => "required|max:255",
        # TODO: Review the validation rule for the
        # value (is 2048 characters too much / enough?)
        "value" => "required|max:2048"
    );

    public static function boot()
    {
        self::observe(new ActivityObserver);
        self::observe(new DataObserver);

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

    public function dataSource()
    {
        return $this->belongsTo("DataSource");
    }

    public function dataType()
    {
        return $this->belongsTo("DataType");
    }

    public function tool()
    {
        return $this->belongsTo("Tool");
    }

    public function user()
    {
        return $this->belongsTo("User");
    }
}
