<?php namespace Repositories\Eloquent;

use ApiKey;
use Repositories\ApiKeyRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class ApiKeyRepository extends AbstractRepository implements ApiKeyRepositoryInterface
{
    protected $model;

    public function __construct(ApiKey $apiKey)
    {
        $this->model = $apiKey;
    }

    public function generateToken($length = 32)
    {
        return $this->model->generateToken($length);
    }
}
