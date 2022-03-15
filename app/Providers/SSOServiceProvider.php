<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SSOServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('App\Http\Controllers\ServerController');
    }

    /**
     * Load necessary routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        $this->loadRoutesFrom(base_path('routes/server.php'));
    }
}
