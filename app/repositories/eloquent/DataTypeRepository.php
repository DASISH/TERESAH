<?php namespace Repositories\Eloquent;

use DataType;
use Repositories\DataTypeRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class DataTypeRepository extends AbstractRepository implements DataTypeRepositoryInterface
{
    protected $model;

    public function __construct(DataType $dataType)
    {
        $this->model = $dataType;
    }

    public function lists($column = "label", $key = "id")
    {
        return $this->model->orderBy($column, "ASC")->lists($column, $key);
    }
}
