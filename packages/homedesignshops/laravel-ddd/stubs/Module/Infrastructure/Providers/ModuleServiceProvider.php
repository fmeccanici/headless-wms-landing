<?php


namespace App\ModuleName\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleNameServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModuleNameRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the modulename routes
     */
    protected function registerModuleNameRoutes(): void
    {
        Route::prefix('modulename')
            ->middleware('web')
            ->namespace('App\\ModuleName\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/modulename')
            ->middleware('api')
            ->namespace('App\\ModuleName\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}
