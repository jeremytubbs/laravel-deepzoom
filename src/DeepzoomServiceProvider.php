<?php

namespace Jeremytubbs\LaravelDeepzoom;

use Illuminate\Support\ServiceProvider;

class DeepzoomServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

        /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/deepzoom.php' => config_path('deepzoom.php'),
        ], 'config');

        $this->commands([
            'Jeremytubbs\LaravelDeepzoom\Console\Commands\MakeTilesCommand',
        ]);
    }
}
