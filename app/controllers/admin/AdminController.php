<?php namespace Admin;

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class AdminController extends BaseController
{
    protected $accessControlList = array();
    protected $layout = "layouts.admin";

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter("@authorize");
    }

    /**
     * Restrict access to administrative section by using 
     * access control lists (ACL).
     * 
     * Allow access to resources by specifying the required 
     * user level and allowed methods inside of each controller 
     * (which extends the AdminController). By specifying the
     * wildcard character (*) as an allowed method for the 
     * user level, you can allow access to all methods under 
     * the controller.
     * 
     * Please note that, by default the access for all resources 
     * is restricted.
     */
    public function authorize()
    {
        $userLevel = Auth::user()->userLevelName();

        if (!array_key_exists($userLevel, $this->accessControlList) || 
            !(in_array(action_name(), $this->accessControlList[$userLevel]) || 
            in_array("*", $this->accessControlList[$userLevel]))) {
            return Redirect::route("pages.show", array("path" => "/"))
                ->with("warning", Lang::get("controllers/admin/admin.authorize.warning"));
        }
    }
}
