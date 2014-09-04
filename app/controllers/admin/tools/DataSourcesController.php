<?php namespace Admin\Tools;

use DataSource;
use Tool;
use Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DataSourcesController extends AdminController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $tool;
    protected $dataSource;
    protected $user;

    public function __construct(Tool $tool, DataSource $dataSource)
    {
        parent::__construct();

        $this->tool = $tool;
        $this->dataSource = $dataSource;
        $this->user = Auth::user();

        $this->beforeFilter("@findTool", array(
            "only" => array("create", "store", "destroy")
        ));
        $this->beforeFilter("@findToolWithAssociatedData", array(
            "only" => array("index", "show")
        ));
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
            ->with("tool", $this->tool);
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
            ->with("tool", $this->tool);
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
        return View::make("admin.tools.data_sources.create", array(
            "tool" => $this->tool, 
            "dataSource" => $this->dataSource, 
            "dataSources" => $this->getDataSources()
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
        $dataSourceId = Input::get("data_source_id");

        # TODO: Check for the existing relationship

        try {
            $this->tool->dataSources()->attach($dataSourceId);

            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers/admin/tools/data_sources.store.success"));
        } catch(\Exception $exception) {
            # TODO: Catch only database related exceptions?
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
        $dataSource = $this->tool->dataSources()->wherePivot("data_source_id", $id)->first();

        try {
            $this->tool->dataSources()->detach($dataSource->id);

            return Redirect::route("admin.tools.data-sources.index", $toolId)
                ->with("success", Lang::get("controllers/admin/tools/data_sources.destroy.success"));
        } catch(\Exception $exception) {
            # TODO: Catch only database related exceptions?
            return Redirect::route("admin.tools.data-sources.delete", $toolId)
                ->with("error", Lang::get("controllers/admin/tools/data_sources.destroy.error"));
        }
    }

    public function findTool($route, $request)
    {
        $this->tool = $this->tool->find($route->getParameter("tools"));
    }

    public function findToolWithAssociatedData($route, $request)
    {
        $toolId = $route->getParameter("tools");
        $this->tool = $this->tool->with(array("user", "dataSources.data" => function($query) use($toolId) {
            $query->where("data.tool_id", "=", $toolId);
        }, "dataSources.data.user", "dataSources.data.dataType"))->find($toolId);
    }

    public function getDataSources()
    {
        return $this->dataSource->orderBy("name", "ASC")->lists("name", "id");
    }
}
