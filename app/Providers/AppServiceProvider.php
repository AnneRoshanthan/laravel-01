<?php

namespace App\Providers;

use App\Broadcasting\MongoDBChannel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(MongoDBChannel::class)
            ->give(function () {
                return new MongoDBChannel();
            });
    }
}
