<?php namespace Services;

interface RepositoryServiceInterface
{
    public function all();

    public function create($input);

    public function destroy($id);

    public function errors();

    public function find($id);

    public function update($id, $input);
}
