<?php

class ApiKeyController extends BaseController
{
    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = Auth::user();
    }

    /**
     * Apply for API Key
     *
     * GET /api_key/apply
     *
     * @return Redirect
     */
    public function create()
    {
        if ($this->user->apiKeys()->where("enabled", "=", "0")->count() != 0)
            return Redirect::route("users.keys")
                ->with("error", Lang::get("controllers.api_key.apply.application_exist"));

        $key = new ApiKey(array("token" => ApiKey::generateToken(), "enabled" => "0"));

        if ($this->user->apiKeys()->save($key)) {
            return Redirect::route("users.keys")
                ->with("success", Lang::get("controllers.api_key.apply.success"));
        } else {
            return Redirect::route("users.keys")
                ->with("error", Lang::get("controllers.api_key.apply.error"));
        }
    }

    public function update($id)
    {
        $key = $this->user->apiKeys()->find($id);

        if ($key != null) {
            $key->description = Input::get("value");

            if ($key->save()) {
                return Response::json(array("status" => 200), 200);
            } else {
                return Response::json($key->getErrors(), 400);
            }
        } else {
            App::abort(404);
        }
    }

    /**
     * Remove the specified ApiKey from storage.
     *
     * DELETE /api-key/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        $key = $this->user->apiKeys()->find($id);

        if ($key != null){
            if ($key->delete()) {
                return Redirect::route("users.keys")
                    ->with("success", Lang::get("controllers.api_key.destroy.success"));
            } else {
                return Redirect::route("users.keys", $id)
                    ->with("error", Lang::get("controllers.api_key.destroy.error"));
            }
        } else {
            App::abort(404);
        }
    }
}
