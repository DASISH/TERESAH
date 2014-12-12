<?php namespace Api\V1\Tools;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\ToolServiceInterface as ToolService;
use Services\DataSourceServiceInterface as DataSourceService;
use Teresah\Support\Facades\Response;

class DataSourcesController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $toolService;
    protected $dataSourceService;

    public function __construct(ToolService $toolService, DataSourceService $dataSourceService)
    {
        parent::__construct();

        $this->toolService = $toolService;
        $this->dataSourceService = $dataSourceService;
    }

    /**
     * Store a newly attached Data Source for the 
     * specified Tool in storage.
     *
     * POST /api/v1/tools/{toolId}/data-sources.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $toolId
     * @return Response
     */
    public function store($toolId)
    {
        try {
            $this->toolService->attachDataSource($toolId, Input::get("data_source_id"));

            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.tools.data_sources.store.success")));
        } catch(\Exception $exception) {
            return Response::jsonWithStatus(422, null, array("errors" => Lang::get("controllers.admin.tools.data_sources.store.error")));
        }
    }

    /**
     * Detach the specified Data Source for specified 
     * Tool from storage.
     *
     * DELETE /api/v1/tools/{toolId}/data-sources/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $toolId
     * @param  int $id
     * @return Response
     */
    public function destroy($toolId, $id)
    {
        try {
            $this->toolService->detachDataSource($toolId, $id);

            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.tools.data_sources.destroy.success")));
        } catch(\Exception $exception) {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.tools.data_sources.destroy.error")));
        }
    }
}
