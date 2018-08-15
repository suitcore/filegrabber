<?php

namespace Suitcore\FileGrabber;

use Illuminate\Support\ServiceProvider;

class FileGrabberServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('filegrab', function ($app) {
            $grabber = new FileGrabber;
            $grabber->setTemp(storage_path('app/grabbers'), 0775);
            return $grabber;
        });
    }
}
