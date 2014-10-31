<?php namespace Services;

use Repositories\DataTypeRepositoryInterface as DataTypeRepository;
use Services\DataTypeServiceInterface;

class DataTypeService extends AbstractRepositoryService implements DataTypeServiceInterface
{
    protected $errors;
    protected $dataTypeRepository;

    public function __construct(DataTypeRepository $dataTypeRepository)
    {
        $this->dataTypeRepository = $this->setRepository($dataTypeRepository);
    }

    public function getDataTypes()
    {
        return $this->dataTypeRepository->lists("label", "id");
    }
}
