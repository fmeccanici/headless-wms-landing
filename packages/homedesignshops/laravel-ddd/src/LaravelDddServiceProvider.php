<?php

namespace HomeDesignShops\LaravelDdd;

use HomeDesignShops\LaravelDdd\Console\ConsoleCommand;
use HomeDesignShops\LaravelDdd\Console\ControllerCommand;
use HomeDesignShops\LaravelDdd\Console\DtoCommand;
use HomeDesignShops\LaravelDdd\Console\NewCommand;
use HomeDesignShops\LaravelDdd\Console\RepositoryCommand;
use HomeDesignShops\LaravelDdd\Console\UseCaseCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class LaravelDddServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-ddd');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-ddd');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-ddd.php'),
            ], 'ddd-config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-ddd'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-ddd'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-ddd'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                NewCommand::class,
                UseCaseCommand::class,
                DtoCommand::class,
                RepositoryCommand::class,
                ConsoleCommand::class,
                ControllerCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-ddd');

        $modulesDir = Str::studly(
            str_replace(
                base_path().DIRECTORY_SEPARATOR,
                '',
                config('laravel-ddd.modules_path')
            )
        );

        // Load the service providers from the modules folder.
        collect((new Filesystem())->directories(app_path()))
            ->filter(static function($path) {
                return Str::endsWith($path, config('laravel-ddd.exclude_paths')) === false;
            })->map(static function($path) {
                return (new Filesystem())->allFiles($path);
            })
            ->collapse()
            ->filter(static function ($filePath) {
                return Str::endsWith($filePath,'ServiceProvider.php');
            })
            ->transform(static function (SplFileInfo $fileInfo) use ($modulesDir) {
                $module = str_replace('ServiceProvider', '', $fileInfo->getFilenameWithoutExtension());
                return "$modulesDir\\$module\\".str_replace(['.'.$fileInfo->getExtension(), '/'], ['', '\\'], $fileInfo->getRelativePathname());
            })
            ->filter(static function ($serviceProviderClass) {
                return class_exists($serviceProviderClass);
            })
            ->each(function ($serviceProviderClass) {
                $this->app->register($serviceProviderClass);
            });
    }
}
