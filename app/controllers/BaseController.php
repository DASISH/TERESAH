<?php

use Illuminate\Support\Facades\Auth;
use Teresah\Support\Facades\Response;

class BaseController extends Controller
{
    protected $accessControlList = array();
    protected $layout = "layouts.default";
    protected $skipAuthentication = array();

    public function __construct()
    {
        if ($this->apiRequest() === false) {
            $this->beforeFilter("auth", array("except" => 
                $this->skipAuthentication));
            $this->beforeFilter("csrf", array("on" => 
                "post", "put", "patch", "delete"));
        }
    }

    protected function apiRequest()
    {
        if (App::environment() == "testing") {
            return false;
        }

        # TODO: Add rule for matching the "api" subdomain
        # (e.g. api.teresah.dasish.eu)
        return (explode("/", $_SERVER["REQUEST_URI"])[1] === "api");
    }

    /**
     * Restrict access by using access control lists (ACL).
     *
     * Allow access to resources by specifying the required 
     * user level and allowed methods inside of each controller 
     * (which extends the BaseController). By specifying the
     * wildcard character (*) as an allowed method for the 
     * user level, you can allow access to all methods under 
     * that specific controller.
     *
     * Please note that, by calling $this->beforeFilter("@authorize"),
     * access for all resources are restricted by default.
     */
    public function authorize()
    {
        $userLevel = Auth::user()->userLevelName();

        if (!array_key_exists($userLevel, $this->accessControlList) || 
            !(in_array(action_name(), $this->accessControlList[$userLevel]) || 
            in_array("*", $this->accessControlList[$userLevel]))) {
            if ($this->apiRequest() === true) {
                return Response::jsonWithStatus(403, null, array("message" => Lang::get("controllers.api.insufficient_privileges")));
            }

            return Redirect::route("pages.show", array("path" => "/"))
                ->with("warning", Lang::get("controllers.admin.authorize.warning"));
        }
    }

    protected function inputWithAuthenticatedUserId($input = array())
    {
        return array_merge($input, array("user_id" => Auth::user()->id));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }
}
