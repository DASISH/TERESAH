<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Login extends Eloquent
{
    use SoftDeletingTrait;

    protected $dates = array("deleted_at");
    protected $fillable = array(
        "user_id",
        "ip_address",
        "user_agent",
        "referer",
        "via_remember"
    );

    public function user()
    {
        return $this->belongsTo("User");
    }

    public static function log($user, $viaRemember = false)
    {
        $user->logins()->create(array(
            "ip_address" => BaseHelper::getIpAddress(),
            "user_agent" => BaseHelper::getUserAgent(),
            "referer" => BaseHelper::getReferer(),
            "via_remember" => $viaRemember
        ));
    }
}
