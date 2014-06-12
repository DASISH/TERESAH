<?php

class ActivityObserver
{
    /**
     * Use the public static function "boot()" in target 
     * model to register the model to use the ActivityObserver.
     * 
     * Available Eloquent model events to hook into:
     *
     * - creating
     * - created
     * - updating 
     * - updated
     * - saving
     * - saved
     * - deleting
     * - deleted
     * - restoring
     * - restored
     */

    public function created($model)
    {
        Activity::log($model, Activity::CREATED);
    }

    public function deleted($model)
    {
        Activity::log($model, Activity::DELETED);
    }

    public function restored($model)
    {
        Activity::log($model, Activity::RESTORED);
    }

    public function updated($model)
    {
        Activity::log($model, Activity::UPDATED);
    }
}
