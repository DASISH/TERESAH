<?php namespace Services;

interface ToolServiceInterface extends RepositoryServiceInterface
{
    public function create($input);
    
    public function attachDataSource($id, $dataSourceId);

    public function detachDataSource($id, $dataSourceId);

    public function findWithAssociatedData($id);

    public function search($parameters);
    
    public function allIncludingSourceLess(array $with, $perPage);
}
