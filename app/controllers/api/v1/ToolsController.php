<?php namespace Api\V1;

use Api\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Services\ToolServiceInterface as ToolService;
use Teresah\Support\Facades\Response;

class ToolsController extends ApiController
{
    protected $accessControlList = array(
        "administrator" => array("*")
    );

    protected $toolService;

    public function __construct(ToolService $toolService)
    {
        parent::__construct();

        $this->toolService = $toolService;
    }

    /**
     * Display a listing of available Tools.
     *
     * GET /api/v1/tools.json(?limit=20)
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @return Response
     */
    public function index()
    {
        # TODO: Order by id DESC and updated_at DESC?
        return Response::jsonWithStatus(200, array("tools" => $this->toolService->all($with = array("user", "dataSources"), $perPage = Input::get("limit", 20))->toArray()));
    }

    /**
     * Search and display a listing of available Tools matching search criteria.
     *
     * GET /api/v1/tools/search.json(?{parameters}|?limit=20)
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @return Response
     */
    public function search()
    {
        $results = $this->toolService->search(Input::all());

        return Response::jsonWithStatus(200, array(
            "tools" => $results["tools"]->toArray(),
            "facets" => $results["facets"]));
    }

    /**
     * Return the specified Tool.
     *
     * GET /api/v1/tools/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return Response::jsonWithStatus(200, $this->toolService->findWithAssociatedData($id)->toArray());
    }

    /**
     * Store a newly created Tool in storage.
     *
     * POST /api/v1/tools.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @return Response
     */
    public function store()
    {
        if ($this->toolService->create($this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(201, null, array("message" => Lang::get("controllers.admin.tools.store.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->toolService->errors()));
        }
    }

    /**
     * Update the specified Tool in storage.
     *
     * PUT/PATCH /api/v1/tools/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        if ($this->toolService->update($id, $this->inputWithAuthenticatedUserId(Input::all()))) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.tools.update.success")));
        } else {
            return Response::jsonWithStatus(422, null, array("errors" => $this->toolService->errors()));
        }
    }

    /**
     * Remove the specified Tool from storage.
     *
     * DELETE /api/v1/tools/{id}.json
     *
     * @api
     * @example documentation/api/v1/tools.md
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->toolService->destroy($id)) {
            return Response::jsonWithStatus(200, null, array("message" => Lang::get("controllers.admin.tools.destroy.success")));
        } else {
            return Response::jsonWithStatus(400, null, array("errors" => Lang::get("controllers.admin.tools.destroy.error")));
        }
    }
}
