<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\UserServiceInterface as UserService;

class UsersController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array(),
        "supervisor" => array(),
        "administrator" => array("*")
    );

    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * Returns all User Account records.
     *
     * GET /admin/users
     * 
     * @return View
     */
    public function index()
    {
        return View::make("admin.users.index")
            ->with("users", $this->userService->all($with = array("logins"), $perPage = 20));
    }

    /**
     * Show the specified User Account.
     *
     * GET /admin/users/{id}
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        return View::make("admin.users.show")
            ->with("user", $this->userService->find($id));
    }

    /**
     * Show the form for creating a new User Account.
     *
     * GET /admin/users/create
     * 
     * @return View
     */
    public function create()
    {
        return View::make("admin.users.create");
    }

    /**
     * Store a newly created User Account in storage.
     *
     * POST /admin/users
     * 
     * @return Redirect
     */
    public function store()
    {
        if ($this->userService->create(Input::all())) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.store.success"));
        } else {
            return Redirect::route("admin.users.create")
                ->withErrors($this->userService->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified User Account.
     *
     * GET /admin/users/{id}/edit
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        return View::make("admin.users.edit")
            ->with("user", $this->userService->find($id));
    }

    /**
     * Update the specified User Account in storage.
     *
     * PUT/PATCH /admin/users/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->userService->update($id, Input::all())) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.update.success"));
        } else {
            return Redirect::route("admin.users.edit", $id)
                ->withErrors($this->userService->errors())->withInput();
        }
    }

    /**
     * Remove the specified User Account from storage.
     *
     * DELETE /admin/users/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->userService->destroy($id)) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.destroy.success"));
        } else {
            return Redirect::route("admin.users.delete", $id)
                ->with("error", Lang::get("controllers/admin/users.destroy.error"));
        }
    }
}
