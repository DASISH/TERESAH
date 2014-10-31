<?php namespace Services;

use Repositories\DataSourceRepositoryInterface as DataSourceRepository;
use Services\DataSourceServiceInterface;

class DataSourceService extends AbstractRepositoryService implements DataSourceServiceInterface
{
    protected $errors;
    protected $dataSourceRepository;

    public function __construct(DataSourceRepository $dataSourceRepository)
    {
        $this->dataSourceRepository = $this->setRepository($dataSourceRepository);
    }
}
