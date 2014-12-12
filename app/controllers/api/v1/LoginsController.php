<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Services\LoginServiceInterface as LoginService;
use Teresah\Support\Facades\Response;

class LoginsController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        parent::__construct();

        $this->loginService = $loginService;
    }

    /**
     * Returns all login records.
     *
     * GET /api/v1/logins.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/logins.md
     * @return Response
     */
    public function index()
    {
        # TODO: Order Api::V1::Users::LoginsController@index by id DESC and created_at DESC?
        return Response::jsonWithStatus(200, array("logins" => $this->loginService->all($with = array("user"), $perPage = Input::get("limit", 20))->toArray()));
    }

    /**
     * Return the specified login record.
     *
     * GET /api/v1/logins/{id}.json
     *
     * @api
     * @example documentation/api/v1/logins.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return Response::jsonWithStatus(200, $this->loginService->find($id, $with = array("user"))->toArray());
    }
}
