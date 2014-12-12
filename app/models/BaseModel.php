<?php

class BaseModel extends Eloquent
{
    /*
     * Return the "created_at", "deleted_at", "updated_at" and
     * "password_reset_sent_at" timestamps in ISO 8601 format.
     */

    public function getCreatedAtAttribute()
    {
        if (isset($this->attributes["created_at"])) {
            return date("c", strtotime($this->attributes["created_at"]));
        }
    }

    public function getDeletedAtAttribute()
    {
        if (isset($this->attributes["deleted_at"])) {
            return date("c", strtotime($this->attributes["deleted_at"]));
        }
    }

    public function getPasswordResetSentAtAttribute()
    {
        if (isset($this->attributes["password_reset_sent_at"])) {
            return date("c", strtotime($this->attributes["password_reset_sent_at"]));
        }
    }

    public function getUpdatedAtAttribute()
    {
        if (isset($this->attributes["updated_at"])) {
            return date("c", strtotime($this->attributes["updated_at"]));
        }
    }
}
