<?php

class UsersController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = Auth::user();
    }

    /**
     * Display an authenticated user's profile.
     *
     * GET /profile
     * 
     * @return View
     */
    public function edit()
    {
        return View::make("users.edit")->withUser($this->user);
    }

    /**
     * Update (store) an authenticated user's profile.
     *
     * PUT/PATCH /profile
     * 
     * @return Redirect
     */
    public function update()
    {
        $user = $this->user->fill(Input::all());

        if ($user->save()) {
            return Redirect::route("users.edit")
                ->with("success", Lang::get("controllers/users.update.success"));
        } else {
            return Redirect::route("users.edit")
                ->withErrors($user->getErrors())->withInput();
        }
    }
}
