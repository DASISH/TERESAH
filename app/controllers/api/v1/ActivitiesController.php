<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Services\ActivityServiceInterface as ActivityService;
use Teresah\Support\Facades\Response;

class ActivitiesController extends ApiController
{
    protected $accessControlList = array(
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
     * GET /api/v1/activities.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/activities.md
     * @return Response
     */
    public function index()
    {
        # TODO: Order Api::V1::ActivitiesController@index by id DESC and created_at DESC?
        return Response::jsonWithStatus(200, array("activities" => $this->activityService->all($with = array("user"), $perPage = Input::get("limit", 20))->toArray()));
    }

    /**
     * Return the specified activity record.
     *
     * GET /api/v1/activities/{id}.json
     *
     * @api
     * @example documentation/api/v1/activities.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return Response::jsonWithStatus(200, $this->activityService->find($id, $with = array("user"))->toArray());
    }
}
