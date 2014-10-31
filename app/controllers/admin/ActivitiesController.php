<?php namespace Admin;

use Illuminate\Support\Facades\View;
use Services\ActivityServiceInterface as ActivityService;

class ActivitiesController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array(),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );

    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        parent::__construct();

        $this->activityService = $activityService;
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
        # TODO: Order Admin::ActivitiesController@index by id DESC and created_at DESC
        return View::make("admin.activities.index")
            ->with("activities", $this->activityService->all($with = array("user"), $perPage = 20))
            ->with("deletedActivities", $this->activityService->getDeleted());
    }
}
