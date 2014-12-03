<?php namespace Services;

use Services\RepositoryServiceInterface;

abstract class AbstractRepositoryService implements RepositoryServiceInterface
{
    protected $errors;
    protected $repository;

    public function all(array $with = array(), $perPage = null)
    {
        return $this->repository->all($with, $perPage);
    }

    public function create($input)
    {
        if ($this->repository->create($input)) {
            return true;
        } else {
            $this->setErrors($this->repository->errors());
        }

        return false;
    }

    public function destroy($id)
    {
        if ($this->repository->destroy($id)) {
            return true;
        } else {
            $this->setErrors($this->repository->errors());
        }

        return false;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function find($id, array $with = array())
    {
        return $this->repository->find($id, $with);
    }

    public function getFirstBy($key, $operator = "=", $value, array $with = array())
    {
        return $this->repository->getFirstBy($key, $operator, $value, $with);
    }

    public function getManyBy($key, $operator = "=", $value, array $with = array())
    {
        return $this->repository->getManyBy($key, $operator, $value, $with);
    }

    public function update($id, $input)
    {
        if ($this->repository->update($id, $input)) {
            return true;
        } else {
            $this->setErrors($this->repository->errors());
        }

        return false;
    }

    protected function setRepository($repository)
    {
        $this->repository = $repository;

        return $this->repository;
    }

    private function setErrors($errors)
    {
        # TODO: Add support for the multiple MessageBags (use merge)?
        $this->errors = $errors;
    }
}
