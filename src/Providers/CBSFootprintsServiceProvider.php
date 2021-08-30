<?php

namespace TNM\CBSFootprints\Providers;

use Illuminate\Support\ServiceProvider;

class CBSFootprintsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }
}
