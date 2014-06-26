<?php namespace Admin;

use User;
use Illuminate\Support\Facades\View;

class UsersController extends AdminController
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Returns all user records.
     *
     * GET /{locale}/admin/users
     * 
     * @return View
     */
    public function index()
    {
        $users = $this->user->with("logins")->orderBy("created_at", "DESC")->paginate(20);

        return View::make("admin.users.index", compact("users"));
    }
}
