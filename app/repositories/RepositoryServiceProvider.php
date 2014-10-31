<?php namespace Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = array(
        "Repositories\ActivityRepositoryInterface" => "Repositories\Eloquent\ActivityRepository",
        "Repositories\ApiKeyRepositoryInterface" => "Repositories\Eloquent\ApiKeyRepository",
        "Repositories\DataRepositoryInterface" => "Repositories\Eloquent\DataRepository",
        "Repositories\DataSourceRepositoryInterface" => "Repositories\Eloquent\DataSourceRepository",
        "Repositories\DataTypeRepositoryInterface" => "Repositories\Eloquent\DataTypeRepository",
        "Repositories\ToolRepositoryInterface" => "Repositories\Eloquent\ToolRepository",
    );

    /**
     * Register the service provider.
     *
     * The public function register() will be triggered
     * automatically by Laravel.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
