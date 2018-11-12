<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\UrlRepository::class, \App\Repositories\UrlRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CrawlerDataRepository::class, \App\Repositories\CrawlerDataRepositoryEloquent::class);
        //:end-bindings:
    }
}
