<?php namespace Admin\Tools\DataSources;

use Data;
use DataSource;
use Tool;
use Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class DataController extends AdminController
{
    protected $tool;
    protected $dataSource;
    protected $data;
    protected $user;

    public function __construct(Tool $tool, DataSource $dataSource, Data $data)
    {
        parent::__construct();

        $this->tool = $tool;
        $this->dataSource = $dataSource;
        $this->data = $data;
        $this->user = Auth::user();
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
        $this->findToolAndDataSource($toolId, $dataSourceId);

        return View::make("admin.tools.data_sources.data.create")
            ->with("tool", $this->tool)
            ->with("dataSource", $this->dataSource)
            ->with("data", $this->data);
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
        $this->findToolAndDataSource($toolId, $dataSourceId);

        $this->data->fill(Input::all());
        $this->data->dataSource()->associate($this->dataSource);
        $this->data->tool()->associate($this->tool);

        if ($this->user->data()->save($this->data)) {
            return Redirect::route("admin.tools.data-sources.index", $toolId)
                ->with("success", Lang::get("controllers/admin/tools/data_sources/data.store.success"));
        } else {
            return Redirect::route("admin.tools.data-sources.data.create", array($toolId, $dataSourceId))
                ->withErrors($this->data->getErrors())->withInput();
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
        $this->findToolAndDataSource($toolId, $dataSourceId);
        $this->data = $this->data->find($id);

        return View::make("admin.tools.data_sources.data.edit")
            ->with("tool", $this->tool)
            ->with("dataSource", $this->dataSource)
            ->with("data", $this->data);
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
        $this->findToolAndDataSource($toolId, $dataSourceId);
        $this->data = $this->data->find($id);

        if (Request::ajax()) {
            $input = Input::all();
            $this->data->$input["name"] = $input["value"];
        } else {
            $this->data->fill(Input::all());
        }
        
        $this->data->dataSource()->associate($this->dataSource);
        $this->data->tool()->associate($this->tool);
        $this->data->user()->associate($this->user);

        if ($this->data->update()) {
            if (Request::ajax()) {
                return Response::json(array("status" => 200), 200);
            }

            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers/admin/tools/data_sources/data.update.success"));
        } else {
            if (Request::ajax()) {
                return Response::json($this->data->getErrors(), 400);
            }

            return Redirect::route("admin.tools.data-sources.data.edit", array($toolId, $dataSourceId, $id))
                ->withErrors($this->data->getErrors())->withInput();
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
        $this->findToolAndDataSource($toolId, $dataSourceId);
        $this->data = $this->data->find($id);

        if ($this->data->delete()) {
            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("success", Lang::get("controllers/admin/tools/data_sources/data.destroy.success"));
        } else {
            return Redirect::route("admin.tools.data-sources.show", array($toolId, $dataSourceId))
                ->with("error", Lang::get("controllers/admin/tools/data_sources/data.destroy.error"));
        }
    }

    private function findToolAndDataSource($toolId, $dataSourceId)
    {
        $this->tool = $this->tool->find($toolId);
        $this->dataSource = $this->tool->dataSources()
            ->wherePivot("data_source_id", $dataSourceId)->first();
    }
}
