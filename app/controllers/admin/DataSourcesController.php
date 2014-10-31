<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\DataSourceServiceInterface as DataSourceService;

class DataSourcesController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array(),
        "supervisor" => array("*"),
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
     * GET /admin/data-sources
     * 
     * @return View
     */
    public function index()
    {
        return View::make("admin.data_sources.index")
            ->with("dataSources", $this->dataSourceService->all($with = array("user"), $perPage = 20));
    }

    /**
     * Show the specified Data Source.
     *
     * GET /admin/data-sources/{id}
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        return View::make("admin.data_sources.show")
            ->with("dataSource", $this->dataSourceService->find($id));
    }

    /**
     * Show the form for creating a new Data Source.
     *
     * GET /admin/data-sources/create
     * 
     * @return View
     */
    public function create()
    {
        return View::make("admin.data_sources.create");
    }

    /**
     * Store a newly created Data Source in storage.
     *
     * POST /admin/data-sources
     * 
     * @return Redirect
     */
    public function store()
    {
        if ($this->dataSourceService->create($this->inputWithAuthenticatedUserId(Input::all()))) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.store.success"));
        } else {
            return Redirect::route("admin.data-sources.create")
                ->withErrors($this->dataSourceService->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified Data Source.
     *
     * GET /admin/data-sources/{id}/edit
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        return View::make("admin.data_sources.edit")
            ->with("dataSource", $this->dataSourceService->find($id));
    }

    /**
     * Update the specified Data Source in storage.
     *
     * PUT/PATCH /admin/data-sources/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->dataSourceService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.update.success"));
        } else {
            return Redirect::route("admin.data-sources.edit", $id)
                ->withErrors($this->dataSourceService->errors())->withInput();
        }
    }

    /**
     * Remove the specified Data Source from storage.
     *
     * DELETE /admin/data-sources/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->dataSourceService->destroy($id)) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.destroy.success"));
        } else {
            return Redirect::route("admin.data-sources.delete", $id)
                ->with("error", Lang::get("controllers/admin/data_sources.destroy.error"));
        }
    }
}
