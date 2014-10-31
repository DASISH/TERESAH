<?php namespace Repositories\Eloquent;

use User;
use Repositories\UserRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
