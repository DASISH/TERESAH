<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\DataSourceServiceInterface as DataSourceService;
use Teresah\Support\Facades\Response;

class DataSourcesController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $dataSourceService;

    public function __construct(DataSourceService $dataSourceService)
    {
        parent::__construct();

        $this->dataSourceService = $dataSourceService;
    }

    /**
     * Display a listing of available Data Sources.
     *
     * GET /api/v1/data-sources.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/data_sources.md
     * @return Response
     */
    public function index()
    {
        return Response::jsonWithStatus(200, array("data_sources" => $this->dataSourceService->all($with = array("user"), $perPage = Input::get("limit", 20))->toArray()));
    }

    /**
     * Return the specified Data Source.
     *
     * GET /api/v1/data-sources/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_sources.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return Response::jsonWithStatus(200, $this->dataSourceService->find($id, $with = array("user"))->toArray());
    }

    /**
     * Store a newly created Data Source in storage.
     *
     * POST /api/v1/data-sources.json
     *
     * @api
     * @example documentation/api/v1/data_sources.md
     * @return Response
     */
    public function store()
    {
        if ($this->dataSourceService->create($this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.data_sources.store.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataSourceService->errors()));
        }
    }

    /**
     * Update the specified Data Source in storage.
     *
     * PUT/PATCH /api/v1/data-sources/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_sources.md
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if ($this->dataSourceService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.data_sources.update.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataSourceService->errors()));
        }
    }

    /**
     * Remove the specified Data Source from storage.
     *
     * DELETE /api/v1/data-sources/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_sources.md
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->dataSourceService->destroy($id)) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.data_sources.destroy.success")));
        } else {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.data_sources.destroy.error")));
        }
    }
}
