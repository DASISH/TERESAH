<?php namespace Api\V1\Tools\DataSources;

use Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\ToolServiceInterface as ToolService;
use Services\DataSourceServiceInterface as DataSourceService;
use Services\DataServiceInterface as DataService;
use Teresah\Support\Facades\Response;

class DataController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $toolService;
    protected $dataSourceService;
    protected $dataService;

    public function __construct(ToolService $toolService, DataSourceService $dataSourceService, DataService $dataService)
    {
        parent::__construct();

        $this->toolService = $toolService;
        $this->dataSourceService = $dataSourceService;
        $this->dataService = $dataService;
    }

    /**
     * Store a newly created Data entry for the specified
     * Data Source and Tool in storage.
     *
     * POST /api/v1/tools/{toolId}/data-sources/{dataSourceId}/data.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $toolId
     * @param  int $dataSourceId
     * @return Response
     */
    public function store($toolId, $dataSourceId)
    {
        $associations = array(
            "data_source_id" => $dataSourceId,
            "tool_id" => $toolId,
            "user_id" => Auth::user()->id
        );

        if ($this->dataService->create(array_merge(Input::all(), $associations))) {
            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.tools.data_sources.data.store.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataService->errors()));
        }
    }

    /**
     * Update the specified Data entry under the specified
     * Data Source and Tool in storage.
     *
     * PUT/PATCH /api/v1/tools/{toolId}/data-sources/{dataSourceId}/data/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $toolId
     * @param  int $dataSourceId
     * @param  int $id
     * @return Response
     */
    public function update($toolId, $dataSourceId, $id)
    {
        $associations = array(
            "data_source_id" => $dataSourceId,
            "tool_id" => $toolId,
            "user_id" => Auth::user()->id
        );

        if ($this->dataService->update($id, array_merge(Input::all(), $associations))) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.tools.data_sources.data.update.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataService->errors()));
        }
    }

    /**
     * Remove the specified Data entry under the 
     * specified Data Source and Tool from storage.
     *
     * DELETE /api/v1/tools/{toolId}/data-sources/{dataSourceId}/data/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $toolId
     * @param  int $dataSourceId
     * @param  int $id
     * @return Response
     */
    public function destroy($toolId, $dataSourceId, $id)
    {
        if ($this->dataService->destroy($id)) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.tools.data_sources.data.destroy.success")));
        } else {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.tools.data_sources.data.destroy.error")));
        }
    }
}
