<?php namespace Repositories\Eloquent;

use Tool;
use Repositories\ToolRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class ToolRepository extends AbstractRepository implements ToolRepositoryInterface
{
    protected $model;

    public function __construct(Tool $tool)
    {
        $this->model = $tool;
    }

    public function attachDataSource($id, $dataSourceId)
    {
        $this->model = $this->find($id);

        return $this->model->dataSources()->attach($dataSourceId);
    }

    public function detachDataSource($id, $dataSourceId)
    {
        $this->model = $this->find($id);

        return $this->model->dataSources()->detach($dataSourceId);
    }
}
