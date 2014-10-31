<?php namespace Services;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected $services = array(
        "Services\ActivityServiceInterface" => "Services\ActivityService",
        "Services\ApiKeyServiceInterface" => "Services\ApiKeyService",
        "Services\DataSourceServiceInterface" => "Services\DataSourceService",
        "Services\DataTypeServiceInterface" => "Services\DataTypeService",
        "Services\ToolServiceInterface" => "Services\ToolService",
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
        foreach ($this->services as $interface => $service) {
            $this->app->bind($interface, $service);
        }
    }
}
