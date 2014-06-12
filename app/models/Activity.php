<?php

use Illuminate\Support\Facades\Request;

class Activity extends Eloquent
{
    const CREATED = 1;
    const UPDATED = 2;
    const DELETED = 3;
    const RESTORED = 4;

    protected $fillable = array(
        "target_type",
        "target_id",
        "action",
        "user_id",
        "ip_address",
        "user_agent",
        "referer"
    );

    public function target()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo("User");
    }

    public static function log($model, $action)
    {
        $model->activity()->create(array(
            "action" => $action,
            "user_id" => self::getUserId($model),
            "ip_address" => self::getIpAddress(),
            "user_agent" => self::getUserAgent(),
            "referer" => self::getReferer()
        ));
    }

    private static function getIpAddress()
    {
        if (!empty(Request::getClientIp())) {
            return Request::getClientIp();
        } else {
            # Otherwise return the IP address of the current server
            return Request::server("SERVER_ADDR");
        }
    }

    private static function getReferer()
    {
        return Request::server("HTTP_REFERER");
    }

    private static function getUserAgent()
    {
        return Request::server("HTTP_USER_AGENT");
    }

    private static function getUserId($model)
    {
        if (get_class($model) == "User") {
            return $model->id;
        } else {
            # TODO: Should we return $model->user()->id() 
            # instead of the Auth::id()?
            return Auth::id();
        }
    }
}
