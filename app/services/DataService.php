<?php namespace Services;

use Repositories\DataRepositoryInterface as DataRepository;
use Services\DataServiceInterface;

class DataService extends AbstractRepositoryService implements DataServiceInterface
{
    protected $errors;
    protected $dataRepository;

    public function __construct(DataRepository $dataRepository)
    {
        $this->dataRepository = $this->setRepository($dataRepository);
    }
}
