<?php namespace Repositories;

interface DataTypeRepositoryInterface extends RepositoryInterface
{
    public function lists($column, $key);
}
