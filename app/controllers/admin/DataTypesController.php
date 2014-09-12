<?php namespace Admin;

use DataType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DataTypesController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array("index", "show", "create", "edit", "store", "update"),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );

    protected $dataType;
    protected $user;

    public function __construct(DataType $dataType)
    {
        parent::__construct();

        $this->dataType = $dataType;
        $this->user = Auth::user();
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
        $dataTypes = $this->dataType->with("user")->orderBy("created_at", "DESC")->paginate(20);

        return View::make("admin.data_types.index", compact("dataTypes"));
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
            ->with("dataType", $this->dataType->find($id));
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
        return View::make("admin.data_types.create")->with("dataType", $this->dataType);
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
        $dataType = $this->dataType->fill(Input::all());

        if ($this->user->dataTypes()->save($dataType)) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.store.success"));
        } else {
            return Redirect::route("admin.data-types.create")
                ->withErrors($dataType->getErrors())->withInput();
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
            ->with("dataType", $this->dataType->find($id));
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
        $dataType = $this->dataType->find($id);

        if ($dataType->update(Input::all())) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.update.success"));
        } else {
            return Redirect::route("admin.data-types.edit", $id)
                ->withErrors($dataType->getErrors())->withInput();
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
        $dataType = $this->dataType->find($id);

        if ($dataType->delete()) {
            return Redirect::route("admin.data-types.index")
                ->with("success", Lang::get("controllers/admin/data_types.destroy.success"));
        } else {
            return Redirect::route("admin.data-types.index")
                ->with("error", Lang::get("controllers/admin/data_types.destroy.error"));
        }
    }
}
