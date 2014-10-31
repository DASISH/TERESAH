<?php namespace Repositories;

interface RepositoryInterface
{
    public function all();

    public function create($input);

    public function destroy($id);

    public function errors();

    public function find($id);

    public function getFirstBy($key, $operator, $value);

    public function getManyBy($key, $operator, $value);

    public function update($id, $input);
}
