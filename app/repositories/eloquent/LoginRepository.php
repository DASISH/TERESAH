<?php namespace Repositories\Eloquent;

use Login;
use Repositories\LoginRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class LoginRepository extends AbstractRepository implements LoginRepositoryInterface
{
    protected $model;

    public function __construct(Login $login)
    {
        $this->model = $login;
    }
}
