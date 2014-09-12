<?php namespace Admin;

use Activity;
use Illuminate\Support\Facades\View;

class ActivitiesController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array(),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );

    protected $activity;

    public function __construct(Activity $activity)
    {
        parent::__construct();

        $this->activity = $activity;
    }

    /**
     * Returns all activity records.
     *
     * GET /admin
     * 
     * @return View
     */
    public function index()
    {
        $activities = $this->activity->with("user")
            ->orderBy("id", "DESC")
            ->orderBy("created_at", "DESC")
            ->paginate(20);
        $deletedActivities = $this->activity->deletedActivities();

        return View::make("admin.activities.index", compact("activities", "deletedActivities"));
    }
}
