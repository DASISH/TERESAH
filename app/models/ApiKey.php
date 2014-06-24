<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ApiKey extends Eloquent
{       
    use SoftDeletingTrait;

    protected $table = "api_keys";
    
    protected $dates = array("deleted_at");
    protected $fillable = array(
        "domain",        
    );
    
    protected $rules = array(
        "domain" => "required|max:255"
    );

    public function user()
    {
        return $this->belongsTo("User");
    }
}
