<?php namespace Repositories;

interface ToolRepositoryInterface extends RepositoryInterface
{
    public function attachDataSource($id, $dataSourceId);

    public function detachDataSource($id, $dataSourceId);
}
