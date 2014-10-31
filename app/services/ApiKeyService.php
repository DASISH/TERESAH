<?php namespace Services;

use Repositories\ApiKeyRepositoryInterface as ApiKeyRepository;
use Services\ApiKeyServiceInterface;

class ApiKeyService extends AbstractRepositoryService implements ApiKeyServiceInterface
{
    protected $errors;
    protected $apiKeyRepository;

    public function __construct(ApiKeyRepository $apiKeyRepository)
    {
        $this->apiKeyRepository = $this->setRepository($apiKeyRepository);
    }

    public function generateToken($length = 32)
    {
        # TODO: Extract the API key token generation from
        # the ApiKey model to the ApiKeyService.
        return $this->apiKeyRepository->generateToken($length);
    }
}
