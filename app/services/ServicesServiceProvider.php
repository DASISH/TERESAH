<?php namespace Services;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected $services = array();

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
