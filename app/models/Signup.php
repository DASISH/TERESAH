<?php

class Signup extends User
{
    protected $table = "users";

    public static function boot()
    {
        parent::boot();
    }
}
