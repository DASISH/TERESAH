<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\UserServiceInterface as UserService;
use Teresah\Support\Facades\Response;

class UsersController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * Display a listing of available Users.
     *
     * GET /api/v1/users.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/users.md
     * @return Response
     */
    public function index()
    {
        $perPage = Input::get("limit", 20);
        $with = array();

        if (Auth::user()->hasAdminAccess()) {
            $with = array("logins");
        }

        # TODO: Order by id ASC and created_at ASC?
        return Response::jsonWithStatus(200, array("users" => $this->userService->all($with, $perPage)->toArray()));
    }

    /**
     * Return the specified User Account.
     *
     * GET /api/v1/users/{id}.json
     *
     * @api
     * @example documentation/api/v1/users.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::user()->hasAdminAccess() || Auth::id() === $id) {
            $with = array("logins");
        }

        return Response::jsonWithStatus(200, $this->userService->find($id, $with)->toArray());
    }

    /**
     * Store a newly created User Account in storage.
     *
     * POST /api/v1/users.json
     *
     * @api
     * @example documentation/api/v1/users.md
     * @return Response
     */
    public function store()
    {
        if ($this->userService->create(Input::all())) {
            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.users.store.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->userService->errors()));
        }
    }

    /**
     * Update the specified User Account in storage.
     *
     * PUT/PATCH /api/v1/users/{id}.json
     *
     * @api
     * @example documentation/api/v1/users.md
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if ($this->userService->update($id, Input::all())) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.users.update.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->userService->errors()));
        }
    }

    /**
     * Remove the specified User Account from storage.
     *
     * DELETE /api/v1/users/{id}.json
     *
     * @api
     * @example documentation/api/v1/users.md
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->userService->destroy($id)) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.users.destroy.success")));
        } else {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.users.destroy.error")));
        }
    }
}
