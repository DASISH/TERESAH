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
    
    public function users()
    {
        return $this->belongsToMany("User")->withTimestamps();
    }
    
    public function similarTools()
    {
        return $this->belongsToMany("Tool", "similar_tools", "tool_id")->withTimestamps();
    }

    public function allSimilarTools(){  
                
        $linked = $this->similarTools()->get();
        $computed = $this->computedMatch()->get();
        $counter = 0;
        
        while(count($linked) < Config::get("teresah.similar_count") && $counter < count($computed))
        {
            $linked[] = $computed[$counter];
            $counter++;
        }
        
        return $linked;
    }
    
    public function scopeHaveDataValueLike($query, $value)
    {
        return $query->whereHas("data", function($query) use($value){
            $query->where("value", "like", "%$value%");
        });
    }
    
    public function scopeMatchingString($query, $value)
    {
        return $query->where("name", "LIKE", "%$value%")->orWhereHas("data", function($query) use($value){
            $query->where("value", "LIKE", "%$value%");
        });
    }
    
    public function scopeComputedMatch($query)
    {
        $computed = Tool::select("tools.id", "tools.name", "tools.slug", DB::raw("COUNT(*) AS matches"))
                    ->join("data", "data.tool_id", "=", "tools.id")
                    ->whereRaw("CONCAT(data.data_type_id, data.slug) IN(SELECT CONCAT(d.data_type_id, d.slug) FROM data d WHERE d.tool_id = $this->id)")
                    ->groupBy("tools.id")
                    ->orderBy("matches", "DESC")
                    ->where("tools.id", "!=", $this->id)
                    ->get();
        
        $similar = array();
        foreach($computed as $c) {
            if($c["matches"] > 1) {
                $similar[] = $c["id"];
            }
        }
        
        $query->whereIn("id", $similar);
    }


    public function scopeHaveFacet($query, $data_type_id, $value)
    {
        return $query->whereHas("data", function($query) use($value, $data_type_id){
            $query->where("slug", $value)->where("data_type_id", $data_type_id);
        });
    }    
    
    public function getAbbreviationAttribute()
    {
        return substr(preg_replace("~\b(\w)|.~", "$1", $this->name), 0, 4);
    }
}
