<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
    */
    public function register(): void
    {
        $this->app->singleton("translator", function ($app) {
            $loader = new FileLoader(new Filesystem, resource_path(("lang")));
            $translator = new Translator($loader, $app["config"]["app.locale"]);

            $translator->setFallback($app["config"]["app.fallback_locale"]);

            return $translator;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
