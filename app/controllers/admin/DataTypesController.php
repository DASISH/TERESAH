<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\DataTypeServiceInterface as DataTypeService;

class DataTypesController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array("index", "show", "create", "edit", "store", "update"),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );

    protected $dataTypeService;

    public function __construct(DataTypeService $dataTypeService)
    {
        parent::__construct();

        $this->dataTypeService = $dataTypeService;
    }

    /**
     * Display a listing of available Data Types.
     *
     * GET /admin/data-types
     * 
     * @return View
     */
    public function index()
    {
        return View::make("admin.data_types.index")
            ->with("dataTypes", $this->dataTypeService->all($with = array("user"), $perPage = 20));
    }

    /**
     * Show the specified Data Type.
     *
     * GET /admin/data-types/{id}
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        return View::make("admin.data_types.show")
            ->with("dataType", $this->dataTypeService->find($id));
    }

    /**
     * Show the form for creating a new Data Type.
     *
     * GET /admin/data-types/create
     * 
     * @return View
     */
    public function create()
    {
        return View::make("admin.data_types.create");
    }

    /**
     * Store a newly created Data Type in storage.
     *
     * POST /admin/data-types
     * 
     * @return Redirect
     */
    public function store()
    {
        if ($this->dataTypeService->create($this->inputWithAuthenticatedUserId(Input::all()))) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.store.success"));
        } else {
            return Redirect::route("admin.data-types.create")
                ->withErrors($this->dataTypeService->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified Data Type.
     *
     * GET /admin/data-types/{id}/edit
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        return View::make("admin.data_types.edit")
            ->with("dataType", $this->dataTypeService->find($id));
    }

    /**
     * Update the specified Data Type in storage.
     *
     * PUT/PATCH /admin/data-types/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->dataTypeService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.update.success"));
        } else {
            return Redirect::route("admin.data-types.edit", $id)
                ->withErrors($this->dataTypeService->errors())->withInput();
        }
    }

    /**
     * Remove the specified Data Type from storage.
     *
     * DELETE /admin/data-types/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->dataTypeService->destroy($id)) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.destroy.success"));
        } else {
            return Redirect::route("admin.data-types.index")
                ->with("error", Lang::get("controllers/admin/data_types.destroy.error"));
        }
    }
}
