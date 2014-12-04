<?php namespace Admin\Tools\DataSources;

use Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Services\DataServiceInterface as DataService;
use Services\DataSourceServiceInterface as DataSourceService;
use Services\DataTypeServiceInterface as DataTypeService;
use Services\ToolServiceInterface as ToolService;

class DataController extends AdminController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $toolService;
    protected $dataSourceService;
    protected $dataTypeService;
    protected $dataService;

    public function __construct(ToolService $toolService, DataSourceService $dataSourceService, DataTypeService $dataTypeService, DataService $dataService)
    {
        parent::__construct();

        $this->toolService = $toolService;
        $this->dataSourceService = $dataSourceService;
        $this->dataTypeService = $dataTypeService;
        $this->dataService = $dataService;
    }

    /**
     * Show the form for creating a new Data entry under 
     * the specified Data Source and Tool.
     *
     * GET /admin/tools/{toolId}/data-sources/{dataSourceId}/data/create
     *
     * @param  int $toolId
     * @param  int $dataSourceId
     * @return View
     */
    public function create($toolId, $dataSourceId)
    {
        # TODO: Abort the app (with error 404) if the tool or
        # data source cannot be found.
        return View::make("admin.tools.data_sources.data.create")
            ->with("tool", $this->toolService->find($toolId))
            ->with("dataSource", $this->dataSourceService->find($dataSourceId))
            ->with("dataTypes", $this->dataTypeService->getDataTypes());
    }

    /**
     * Store a newly created Data entry for the specified
     * Data Source and Tool in storage.
     *
     * POST /admin/tools/{toolId}/data-sources/{dataSourceId}/data
     *
     * @return Redirect
     */
    public function store($toolId, $dataSourceId)
    {
        $associations = array(
            "data_source_id" => $dataSourceId,
            "tool_id" => $toolId,
            "user_id" => Auth::user()->id
        );

        if ($this->dataService->create(array_merge(Input::all(), $associations))) {
            return Redirect::route("admin.tools.data-sources.index", $toolId)
                ->with("success", Lang::get("controllers.admin.tools.data_sources.data.store.success"));
        } else {
            return Redirect::route("admin.tools.data-sources.data.create", array($toolId, $dataSourceId))
                ->withErrors($this->dataService->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified Data entry
     * under the specified Data Source and Tool.
     *
     * GET /admin/tools/{toolId}/data-sources/{dataSourceId}/data/{id}/edit
     *
     * @param  int $toolId
     * @param  int $dataSourceId
     * @param  int $id
     * @return View
     */
    public function edit($toolId, $dataSourceId, $id)
    {
        return View::make("admin.tools.data_sources.data.edit")
            ->with("tool", $this->toolService->find($toolId))
            ->with("dataSource", $this->dataSourceService->find($dataSourceId))
            ->with("dataTypes", $this->dataTypeService->getDataTypes())
            ->with("data", $this->dataService->find($id));
    }

    /**
     * Update the specified Data entry under the specified
     * Data Source and Tool in storage.
     *
     * PUT/PATCH /admin/tools/{toolId}/data-sources/{dataSourceId}/data/{id}
     *
     * @param  int $toolId
     * @param  int $dataSourceId
     * @param  int $id
     * @return Redirect|Response
     */
    public function update($toolId, $dataSourceId, $id)
    {
        $data = array(
            "data_source_id" => $dataSourceId,
            "tool_id" => $toolId,
            "user_id" => Auth::user()->id
        );

        if (Request::ajax()) {
            $input = Input::all();
            $data[$input["name"]] = $input["value"];
        }

        if ($this->dataService->update($id, array_merge(Input::all(), $data))) {
            if (Request::ajax()) {
                return Response::json(array("status" => 200), 200);
            }

            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers.admin.tools.data_sources.data.update.success"));
        } else {
            if (Request::ajax()) {
                return Response::json($this->dataService->errors(), 400);
            }

            return Redirect::route("admin.tools.data-sources.data.edit", array($toolId, $dataSourceId, $id))
                ->withErrors($this->dataService->errors())->withInput();
        }
    }

    /**
     * Remove the specified Data entry under the 
     * specified Data Source and Tool from storage.
     *
     * DELETE /admin/tools/{toolId}/data-sources/{dataSourceId}/data/{id}
     *
     * @param  int $toolId
     * @param  int $dataSourceId
     * @param  int $id
     * @return Redirect
     */
    public function destroy($toolId, $dataSourceId, $id)
    {
        if ($this->dataService->destroy($id)) {
            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers.admin.tools.data_sources.data.destroy.success"));
        } else {
            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("error", Lang::get("controllers.admin.tools.data_sources.data.destroy.error"));
        }
    }
}
