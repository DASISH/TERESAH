<?php namespace Admin;

use Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ToolsController extends AdminController
{
    protected $tool;
    protected $user;

    public function __construct(Tool $tool)
    {
        parent::__construct();

        $this->tool = $tool;
        $this->user = Auth::user();
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
        $tools = $this->tool->with("user")
            ->orderBy("id", "DESC")
            ->orderBy("updated_at", "DESC")
            ->paginate(20);

        return View::make("admin.tools.index", compact("tools"));
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
            ->with("tool", $this->tool->find($id));
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
        return View::make("admin.tools.create")->with("tool", $this->tool);
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
        $tool = $this->tool->fill(Input::all());

        if ($this->user->tools()->save($tool)) {
            return Redirect::route("admin.tools.index")
                ->with("success", Lang::get("controllers/admin/tools.store.success"));
        } else {
            return Redirect::route("admin.tools.create")
                ->withErrors($tool->getErrors())->withInput();
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
            ->with("tool", $this->tool->find($id));
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
        $tool = $this->tool->find($id);

        if ($tool->update(Input::all())) {
            return Redirect::route("admin.tools.index")
                ->with("success", Lang::get("controllers/admin/tools.update.success"));
        } else {
            return Redirect::route("admin.tools.edit", $id)
                ->withErrors($tool->getErrors())->withInput();
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
        $tool = $this->tool->find($id);

        if ($tool->delete()) {
            return Redirect::route("admin.tools.index")
                ->with("success", Lang::get("controllers/admin/tools.destroy.success"));
        } else {
            return Redirect::route("admin.tools.delete", $id)
                ->with("error", Lang::get("controllers/admin/tools.destroy.error"));
        }
    }
}
