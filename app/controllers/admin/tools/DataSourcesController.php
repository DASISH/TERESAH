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
    protected $dataSources;
    protected $user;

    public function __construct(Tool $tool, DataSource $dataSource)
    {
        parent::__construct();

        $this->tool = $tool;
        $this->dataSource = $dataSource;
        $this->dataSources = $dataSource;
        $this->user = Auth::user();
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
        $this->tool = $this->tool->find($toolId);
        $this->getDataSources();
        $this->dataSource = $this->dataSources->first();

        # Share the view with the show action
        return View::make("admin.tools.data_sources.show")
            ->with("tool", $this->tool)
            ->with("dataSources", $this->dataSources)
            ->with("dataSource", $this->dataSource)
            ->with("dataSourceData", $this->tool->data()->where("data_source_id", $this->dataSource->id)->get());
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
        $this->findToolAndDataSource($toolId, $id);
        $this->getDataSources();

        return View::make("admin.tools.data_sources.show")
            ->with("tool", $this->tool)
            ->with("dataSources", $this->dataSources)
            ->with("dataSource", $this->dataSource)
            ->with("dataSourceData", $this->tool->data()->where("data_source_id", $this->dataSource->id)->get());
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
        $tool = $this->tool->find($toolId);
        $dataSource = $this->dataSource;
        $availableDataSources = $this->dataSource->orderBy("name", "ASC")->lists("name", "id");

        return View::make("admin.tools.data_sources.create", compact("tool", "dataSource", "availableDataSources"));
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
        $tool = $this->tool->find($toolId);
        $dataSourceId = Input::get("data_source_id");

        # TODO: Check for the existing relationship

        try {
            $tool->dataSources()->attach($dataSourceId);

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
        $tool = $this->tool->find($toolId);
        $dataSource = $tool->dataSources()->wherePivot("data_source_id", $id)->first();

        try {
            $tool->dataSources()->detach($dataSource->id);

            return Redirect::route("admin.tools.data-sources.index", $toolId)
                ->with("success", Lang::get("controllers/admin/tools/data_sources.destroy.success"));
        } catch(\Exception $exception) {
            # TODO: Catch only database related exceptions?
            return Redirect::route("admin.tools.data-sources.delete", $toolId)
                ->with("error", Lang::get("controllers/admin/tools/data_sources.destroy.error"));
        }
    }

    private function findToolAndDataSource($toolId, $id)
    {
        $this->tool = $this->tool->find($toolId);
        $this->dataSource = $this->tool->dataSources()
            ->wherePivot("data_source_id", $id)->first();
    }

    private function getDataSources()
    {
        $this->dataSources = $this->tool->dataSources()
            ->orderBy("data_sources.name", "ASC")->get();
    }

    private function getDataValue($key)
    {
        $data = $this->dataSource->data->lists("value", "key");

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }
}
