<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\DataTypeServiceInterface as DataTypeService;
use Teresah\Support\Facades\Response;

class DataTypesController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $dataTypeService;

    public function __construct(DataTypeService $dataTypeService)
    {
        parent::__construct();

        $this->dataTypeService = $dataTypeService;
    }

    /**
     * Display a listing of available Data Types.
     *
     * GET /api/v1/data-types.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/data_types.md
     * @return Response
     */
    public function index()
    {
        return Response::jsonWithStatus(200, array("data_types" => $this->dataTypeService->all($with = array("user"), $perPage = Input::get("limit", 20))->toArray()));
    }

    /**
     * Return the specified Data Type.
     *
     * GET /api/v1/data-types/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_types.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return Response::jsonWithStatus(200, $this->dataTypeService->find($id, $with = array("user"))->toArray());
    }

    /**
     * Store a newly created Data Type in storage.
     *
     * POST /api/v1/data-types.json
     *
     * @api
     * @example documentation/api/v1/data_types.md
     * @return Response
     */
    public function store()
    {
        if ($this->dataTypeService->create($this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.data_types.store.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataTypeService->errors()));
        }
    }

    /**
     * Update the specified Data Type in storage.
     *
     * PUT/PATCH /api/v1/data-types/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_types.md
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if ($this->dataTypeService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.data_types.update.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->dataTypeService->errors()));
        }
    }

    /**
     * Remove the specified Data Type from storage.
     *
     * DELETE /api/v1/data-types/{id}.json
     *
     * @api
     * @example documentation/api/v1/data_types.md
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->dataTypeService->destroy($id)) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.data_types.destroy.success")));
        } else {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.data_types.destroy.error")));
        }
    }
}
