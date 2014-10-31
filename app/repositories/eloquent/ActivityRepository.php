<?php namespace Repositories\Eloquent;

use Activity;
use Repositories\ActivityRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class ActivityRepository extends AbstractRepository implements ActivityRepositoryInterface
{
    protected $model;

    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    public function deletedActivities() {
        return $this->model->deletedActivities();
    }
}
