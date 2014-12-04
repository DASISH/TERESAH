<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\ApiKeyServiceInterface as ApiKeyService;
use Services\UserServiceInterface as UserService;

class ApiKeysController extends AdminController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $apiKeyService;
    protected $userService;

    public function __construct(ApiKeyService $apiKeyService, UserService $userService)
    {
        parent::__construct();

        $this->apiKeyService = $apiKeyService;
        $this->userService = $userService;
    }

    /**
     * Returns all API Key records.
     *
     * GET /admin/api
     *
     * @return View
     */
    public function index()
    {
        # TODO: Order Admin::ApiKeysController@index by id DESC and updated_at DESC
        return View::make("admin.api_keys.index")
            ->with("apiKeys", $this->apiKeyService->all($with = array("user"), $perPage = 20));
    }

    /**
     * Show the form for creating a new API Key.
     *
     * GET /admin/api/create
     *
     * @return View
     */
    public function create()
    {
        return View::make("admin.api_keys.create")
            ->with("apiKeyToken", $this->apiKeyService->generateToken())
            ->with("users", $this->userService->getActiveUsers());
    }

    /**
     * Store a newly created API Key in storage.
     *
     * POST /admin/api
     *
     * @return Redirect
     */
    public function store()
    {
        if ($this->apiKeyService->create(Input::all())) {
            return Redirect::route("admin.api.index")
                ->with("success", Lang::get("controllers.admin.api_keys.store.success"));
        } else {
            return Redirect::route("admin.api.create")
                ->withErrors($this->apiKeyService->errors())->withInput();
        }
    }

    /**
     * Show the form for editing the specified API Key.
     *
     * GET /admin/api/{id}/edit
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $apiKey = $this->apiKeyService->find($id);

        return View::make("admin.api_keys.edit")
            ->with("apiKey", $apiKey)
            ->with("apiKeyToken", $apiKey->token)
            ->with("users", $this->userService->getActiveUsers());
    }

    /**
     * Update the specified API Key in storage.
     *
     * PUT/PATCH /admin/api/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->apiKeyService->update($id, Input::all())) {
            return Redirect::route("admin.api.index")
                ->with("success", Lang::get("controllers.admin.api_keys.update.success"));
        } else {
            return Redirect::route("admin.api.edit", $id)
                ->withErrors($this->apiKeyService->errors())->withInput();
        }
    }

    /**
     * Remove the specified API Key from storage.
     *
     * DELETE /admin/api/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->apiKeyService->destroy($id)) {
            return Redirect::route("admin.api.index")
                ->with("success", Lang::get("controllers.admin.api_keys.destroy.success"));
        } else {
            return Redirect::route("admin.api.index")
                ->with("error", Lang::get("controllers.admin.api_keys.destroy.error"));
        }
    }
}
