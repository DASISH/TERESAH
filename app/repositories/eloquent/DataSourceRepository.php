<?php namespace Repositories\Eloquent;

use DataSource;
use Repositories\DataSourceRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class DataSourceRepository extends AbstractRepository implements DataSourceRepositoryInterface
{
    protected $model;

    public function __construct(DataSource $dataSource)
    {
        $this->model = $dataSource;
    }
}
