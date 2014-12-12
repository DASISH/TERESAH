<?php namespace Admin;

use BaseController;

class AdminController extends BaseController
{
    protected $layout = "layouts.admin";

    public function __construct()
    {
        parent::__construct();

        $this->beforeFilter("@authorize");
    }
}
