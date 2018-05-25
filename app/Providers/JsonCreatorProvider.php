<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Library\JsonRequestResponse;
class JsonCreatorProvider extends ServiceProvider
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
        $this->app->bind('\App\Library\JsonRequestResponse',function($app, Boolean $success, $data){
            $response = new JsonRequestResponse($success,$data);
            return $response;
        });
    }
}
