<?php

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
        "metadata",
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

    public function getMetadata()
    {
        return json_decode($this->metadata, true);
    }

    public function getNameAttribute()
    {
        # TODO: Translate the "error" message
        return isset($this->getMetadata()["name"]) ? $this->getMetadata()["name"] : "Unknown (cannot resolve the name)";
    }

    public function getPreviousNameAttribute()
    {
        return isset($this->getMetadata()["previous_name"]) ? $this->getMetadata()["previous_name"] : null;
    }

    public static function log($model, $action)
    {
        $model->activity()->create(array(
            "action" => $action,
            "user_id" => self::getUserId($model),
            "metadata" => json_encode(self::detectName($model), JSON_UNESCAPED_UNICODE),
            "ip_address" => BaseHelper::getIpAddress(),
            "user_agent" => BaseHelper::getUserAgent(),
            "referer" => BaseHelper::getReferer()
        ));
    }

    private static function detectName($model)
    {
        $detectedAttributes = array("name", "title");

        foreach ($detectedAttributes as $attribute) {
            if (isset($model->attributes[$attribute])) {
                if ($model->attributes[$attribute] != $model->getOriginal($attribute) && 
                    !empty($model->getOriginal($attribute))) {
                    return array(
                        "name" => $model->attributes[$attribute],
                        "previous_name" => $model->getOriginal($attribute)
                    );
                } else {
                    return array("name" => $model->attributes[$attribute]);
                }
            }
        }
    }

    private static function getUserId($model)
    {
        $detectedUserModels = array("Signup", "User");

        if (!Auth::check()) {
            if (in_array(get_class($model), $detectedUserModels)) {
                return $model->id;
            }

            return $model->user->id;
        }

        return Auth::id();
    }
}
