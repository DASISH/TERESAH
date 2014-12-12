<?php namespace Services;

use Repositories\LoginRepositoryInterface as LoginRepository;
use Services\LoginServiceInterface;

class LoginService extends AbstractRepositoryService implements LoginServiceInterface
{
    protected $errors;
    protected $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $this->setRepository($loginRepository);
    }
}
