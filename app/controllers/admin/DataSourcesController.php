<?php namespace Admin;

use DataSource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DataSourcesController extends AdminController
{
    protected $dataSource;
    protected $user;

    public function __construct(DataSource $dataSource)
    {
        parent::__construct();

        $this->dataSource = $dataSource;
        $this->user = Auth::user();
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
        $dataSources = $this->dataSource->with("user")->orderBy("created_at", "DESC")->paginate(20);

        return View::make("admin.data_sources.index", compact("dataSources"));
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
            ->with("dataSource", $this->dataSource->find($id));
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
        return View::make("admin.data_sources.create")->with("dataSource", $this->dataSource);
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
        $dataSource = $this->dataSource->fill(Input::all());

        if ($this->user->dataSources()->save($dataSource)) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.store.success"));
        } else {
            return Redirect::route("admin.data-sources.create")
                ->withErrors($dataSource->getErrors())->withInput();
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
            ->with("dataSource", $this->dataSource->find($id));
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
        $dataSource = $this->dataSource->find($id);

        if ($dataSource->update(Input::all())) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.update.success"));
        } else {
            return Redirect::route("admin.data-sources.edit", $id)
                ->withErrors($dataSource->getErrors())->withInput();
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
        $dataSource = $this->dataSource->find($id);

        if ($dataSource->delete()) {
            return Redirect::route("admin.data-sources.index")
                ->with("success", Lang::get("controllers/admin/data_sources.destroy.success"));
        } else {
            return Redirect::route("admin.data-sources.delete", $id)
                ->with("error", Lang::get("controllers/admin/data_sources.destroy.error"));
        }
    }
}
