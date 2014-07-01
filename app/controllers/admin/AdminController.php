<?php namespace Admin;

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class AdminController extends BaseController
{
    protected $layout = "layouts.admin";

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter("@authorize");
    }

    public function authorize()
    {
        if (!Auth::user()->isAdministrator()) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("warning", Lang::get("controllers/admin/admin.authorize.warning"));
        }
    }
}
