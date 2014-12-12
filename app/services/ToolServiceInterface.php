<?php namespace Services;

interface ToolServiceInterface extends RepositoryServiceInterface
{
    public function attachDataSource($id, $dataSourceId);

    public function detachDataSource($id, $dataSourceId);

    public function findWithAssociatedData($id);

    public function search($parameters);
}
