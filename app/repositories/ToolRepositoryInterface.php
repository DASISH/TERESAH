<?php namespace Repositories;

interface ToolRepositoryInterface extends RepositoryInterface
{
    public function find($id);

    public function attachDataSource($id, $dataSourceId);

    public function detachDataSource($id, $dataSourceId);

    public function byAlphabet($startsWith);

    public function random();
    
    public function popular();
    
    public function latest();

    public function search($parameters);
    
    public function allIncludingSourceLess(array $with, $perPage);
}
