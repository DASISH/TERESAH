<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\ToolServiceInterface as ToolService;

class ToolsController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array("index", "show", "create", "edit", "store", "update"),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );

    protected $toolService;

    public function __construct(ToolService $toolService)
    {
        parent::__construct();

        $this->toolService = $toolService;
    }

    /**
     * Display a listing of available Tools.
     *
     * GET /admin/tools
     *
     * @return View
     */
    public function index()
    {
        return View::make("admin.tools.index")
            ->with("tools", $this->toolService->allIncludingSourceLess($with = array("user"), $perPage = 20));
    }

    /**
     * Show the specified Tool.
     *
     * GET /admin/tools/{id}
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        return View::make("admin.tools.show")
            ->with("tool", $this->toolService->find($id));
    }

    /**
     * Show the form for creating a new Tool.
     *
     * GET /admin/tools/create
     *
     * @return View
     */
    public function create()
    {
        return View::make("admin.tools.create");
    }

    /**
     * Store a newly created Tool in storage.
     *
     * POST /admin/tools
     *
     * @return Redirect
     */
    public function store()
    {
        $response = $this->toolService->create($this->inputWithAuthenticatedUserId(Input::all()));
          
        if ($response["success"]) {
            return Redirect::route("admin.tools.data-sources.index", array("toolId" => $response["id"]))                
                ->with("success", Lang::get("controllers.admin.tools.store.success"));
        } else {
            return Redirect::route("admin.tools.create")
                ->withErrors($response["errors"])->withInput();
        }
    }

    /**
     * Show the form for editing the specified Tool.
     *
     * GET /admin/tools/{id}/edit
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        return View::make("admin.tools.edit")
            ->with("tool", $this->toolService->find($id));
    }

    /**
     * Update the specified Tool in storage.
     *
     * PUT/PATCH /admin/tools/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->toolService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Redirect::route("admin.tools.index")
                ->with("success", Lang::get("controllers.admin.tools.update.success"));
        } else {
            return Redirect::route("admin.tools.edit", $id)
                ->withErrors($this->toolService->errors())->withInput();
        }
    }

    /**
     * Remove the specified Tool from storage.
     *
     * DELETE /admin/tools/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->toolService->destroy($id)) {
            return Redirect::route("admin.tools.index")
                ->with("success", Lang::get("controllers.admin.tools.destroy.success"));
        } else {
            return Redirect::route("admin.tools.delete", $id)
                ->with("error", Lang::get("controllers.admin.tools.destroy.error"));
        }
    }
}
