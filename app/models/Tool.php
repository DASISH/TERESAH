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

    public function user()
    {
        return $this->belongsTo("User");
    }

    public function getAbbreviation($length = 4)
    {
        return substr(preg_replace("~\b(\w)|.~", "$1", $this->name), 0, $length);
    }

    public function getDataValue($key)
    {
        $data = $this->data->lists("value", "key");

        # TODO: Add case-insensitive search for the array key
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }

    public static function generateSlug($string, $replace = array("'"), $delimiter = "-")
    {
        setlocale(LC_ALL, "en_US.UTF8");

        if (!empty($replace)) {
            $string = str_replace((array)$replace, " ", $string);
        }

        $slug = iconv("UTF-8", "ASCII//TRANSLIT", $string);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", "", $slug);
        $slug = strtolower(trim($slug, "-"));
        $slug = preg_replace("/[\/_|+ -]+/", $delimiter, $slug);

        return $slug;
    }
}
