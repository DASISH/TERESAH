<?php

class BaseController extends Controller
{
    protected $layout = "layouts.default";
    protected $skipAuthentication = array();

    public function __construct()
    {
        $this->beforeFilter("auth", array("except" => 
            $this->skipAuthentication));
        $this->beforeFilter("csrf", array("on" => 
            "post", "put", "patch", "delete"));
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
