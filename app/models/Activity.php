<?php

class Activity extends BaseModel
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

    public function actionName()
    {
        switch ($this->action) {
            case $this->isCreated():
                return "created";
                break;

            case $this->isUpdated():
                return "updated";
                break;

            case $this->isDeleted():
                return "deleted";
                break;

            case $this->isRestored():
                return "restored";
                break;
        }
    }

    public function existsIn($activities = array())
    {
        foreach ($activities as $activity) {
            if ($activity->target_type == $this->target_type &&
                $activity->target_id == $this->target_id &&
                $activity->action == self::DELETED) {
                return true;
            }
        }

        return false;
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

    public function isCreated()
    {
        return $this->action == self::CREATED;
    }

    public function isUpdated()
    {
        return $this->action == self::UPDATED;
    }

    public function isDeleted()
    {
        return $this->action == self::DELETED;
    }

    public function isRestored()
    {
        return $this->action == self::RESTORED;
    }

    public static function deletedActivities()
    {
        $table = "activities";
        $joinTable = "joined_activities";

        return self::select(
                "{$table}.target_type", "{$table}.target_id", 
                "{$table}.action", "{$table}.created_at"
            )->leftJoin("{$table} as {$joinTable}", function($join) use ($table, $joinTable) {
                $join->on("{$table}.target_type", "=", "{$joinTable}.target_type")
                     ->on("{$table}.target_id", "=", "{$joinTable}.target_id")
                     ->on("{$table}.created_at", "<", "{$joinTable}.created_at");
            })
            ->whereIn("{$table}.action", array(self::DELETED, self::RESTORED))
            ->whereNull("{$joinTable}.created_at")
            ->get();
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
        $detectedAttributes = array("name", "label", "title", "key");

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
