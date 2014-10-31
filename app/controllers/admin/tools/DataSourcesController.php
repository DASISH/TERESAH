<?php namespace Admin\Tools;

use Admin\AdminController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\DataSourceServiceInterface as DataSourceService;
use Services\ToolServiceInterface as ToolService;

class DataSourcesController extends AdminController
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
     * Display a listing of available Data Sources for 
     * the specified Tool.
     *
     * GET /admin/tools/{toolId}/data-sources
     *
     * @param  int $toolId
     * @return View
     */
    public function index($toolId)
    {
        # Share the view with the show action
        return View::make("admin.tools.data_sources.show")
            ->with("tool", $this->toolService->findWithAssociatedData($toolId));
    }

    /**
     * Show the specified Data Source for the specified Tool.
     *
     * GET /admin/tools/{toolId}/data-sources/{id}
     *
     * @param  int $toolId
     * @param  int $id
     * @return View
     */
    public function show($toolId, $id)
    {
        return View::make("admin.tools.data_sources.show")
            ->with("tool", $this->toolService->findWithAssociatedData($toolId));
    }

    /**
     * Show the form for attaching a new Data Source for
     * the specified Tool.
     *
     * GET /admin/tools/{toolId}/data-sources/create
     *
     * @param  int $toolId
     * @return View
     */
    public function create($toolId)
    {
        # TODO: Abstract the lists() function out from the controller (function belongs to repository/service)
        return View::make("admin.tools.data_sources.create", array(
            "tool" => $this->toolService->find($toolId), 
            "dataSources" => $this->dataSourceService->all()->lists("name", "id")
        ));
    }

    /**
     * Store a newly attached Data Source for the 
     * specified Tool in storage.
     *
     * POST /admin/tools/{toolId}/data-sources
     *
     * @param  int $toolId
     * @return Redirect
     */
    public function store($toolId)
    {
        try {
            $dataSourceId = Input::get("data_source_id");
            $this->toolService->attachDataSource($toolId, $dataSourceId);

            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers/admin/tools/data_sources.store.success"));
        } catch(\Exception $exception) {
            return Redirect::route("admin.tools.data-sources.create", $toolId)
                ->with("error", Lang::get("controllers/admin/tools/data_sources.store.error"));
        }
    }

    /**
     * Detach the specified Data Source for specified 
     * Tool from storage.
     *
     * DELETE /admin/tools/{toolId}/data-sources/{id}
     *
     * @param  int $toolId
     * @param  int $id
     * @return Redirect
     */
    public function destroy($toolId, $id)
    {
        try {
            $this->toolService->detachDataSource($toolId, $id);

            return Redirect::route("admin.tools.data-sources.index", $toolId)
                ->with("success", Lang::get("controllers/admin/tools/data_sources.destroy.success"));
        } catch(\Exception $exception) {
            return Redirect::route("admin.tools.data-sources.delete", $toolId)
                ->with("error", Lang::get("controllers/admin/tools/data_sources.destroy.error"));
        }
    }
}
