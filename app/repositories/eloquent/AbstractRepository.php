<?php namespace Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Repositories\RepositoryInterface;

# TODO: AbstractRepository: Handle record not found cases
abstract class AbstractRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $with = array(), $perPage = null)
    {
        # TODO: Add support for ordering with multiple columns
        # TODO: Extract/remove the pagination?

        if (isset($perPage) && is_numeric($perPage)) {
            return $this->make($with)->orderBy("created_at", "DESC")->paginate($perPage);
        }

        return $this->make($with)->orderBy("created_at", "DESC");
    }

    public function create($input)
    {
        return $this->model->fill($input)->save();
    }

    public function destroy($id)
    {
        $this->model = $this->find($id);

        return $this->model->delete($id);
    }

    public function errors()
    {
        return $this->model->getErrors();
    }

    public function find($id, array $with = array())
    {
        return $this->make($with)->find($id);
    }

    public function getFirstBy($key, $operator = "=", $value, array $with = array())
    {
        return $this->make($with)->where($key, $operator, $value)->first();
    }

    public function getManyBy($key, $operator = "=", $value, array $with = array(), $perPage = null)
    {
        if (isset($perPage) && is_numeric($perPage)) {
            return $this->make($with)->where($key, $operator, $value)->paginate($perPage);
        }

        return $this->make($with)->where($key, $operator, $value)->get();
    }

    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    public function update($id, $input)
    {
        $this->model = $this->find($id);

        return $this->model->update($input);
    }
}
