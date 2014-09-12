<?php namespace Admin;

use User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UsersController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array(),
        "supervisor" => array(),
        "administrator" => array("*")
    );

    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
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
        $users = $this->user->with("logins")
            ->orderBy("id", "DESC")
            ->orderBy("created_at", "DESC")
            ->paginate(20);

        return View::make("admin.users.index", compact("users"));
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
            ->with("user", $this->user->find($id));
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
        return View::make("admin.users.create")->with("user", $this->user);
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
        $user = $this->user->fill(Input::all());
        $user->active = Input::get("active");
        $user->user_level = Input::get("user_level");

        if ($user->save()) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.store.success"));
        } else {
            return Redirect::route("admin.users.create")
                ->withErrors($user->getErrors())->withInput();
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
            ->with("user", $this->user->find($id));
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
        $user = $this->user->find($id)->fill(Input::all());
        $user->active = Input::get("active");
        $user->user_level = Input::get("user_level");

        if ($user->update()) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.update.success"));
        } else {
            return Redirect::route("admin.users.edit", $id)
                ->withErrors($user->getErrors())->withInput();
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
        $user = $this->user->find($id);
        $user->disablePasswordValidation();

        if ($user->delete()) {
            return Redirect::route("admin.users.index")
                ->with("success", Lang::get("controllers/admin/users.destroy.success"));
        } else {
            return Redirect::route("admin.users.delete", $id)
                ->with("error", Lang::get("controllers/admin/users.destroy.error"));
        }
    }
}
