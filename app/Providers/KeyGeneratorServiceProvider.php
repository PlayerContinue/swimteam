<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\KeyGenerator;
class KeyGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\KeyGenerator', function ($app) {
          return new KeyGenerator();
        });
    }
}
