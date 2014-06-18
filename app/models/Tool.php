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

    # Add unique identifier to the rules when performing 
    # validation. Otherwise if the model already exists 
    # and it has unique validations, it is going to fail
    # the validation.
    protected $injectUniqueIdentifier = true;

    public static function boot()
    {
        parent::boot();

        self::observe(new ActivityObserver);
        self::observe(new ToolObserver);

        # FIXME/TODO: The public static "bootValidatingTrait()" function
        # in the Validating trait (Watson/Validating/ValidatingTrait.php) 
        # doesn't seem to work at the moment. Using the following
        # "workaround" in order to use the ValidatingObserver.
        # 
        self::observe(new ValidatingObserver);
        # End of the "workaround"
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
