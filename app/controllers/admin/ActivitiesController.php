<?php namespace Admin;

use Activity;
use Illuminate\Support\Facades\View;

class ActivitiesController extends AdminController
{
    protected $activity;

    public function __construct(Activity $activity)
    {
        parent::__construct();

        $this->activity = $activity;
    }

    /**
     * Returns all activity records.
     *
     * GET /{locale}/admin
     * 
     * @return View
     */
    public function index()
    {
        $activities = $this->activity->with("user")->orderBy("created_at", "DESC")->paginate(20);

        return View::make("admin.activities.index", compact("activities"));
    }
}
