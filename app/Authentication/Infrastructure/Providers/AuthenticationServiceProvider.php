<?php


namespace App\Authentication\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthenticationServiceProvider extends ServiceProvider
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
        $this->registerAuthenticationRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the authentication routes
     */
    protected function registerAuthenticationRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace('App\\Authentication\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');

        Route::prefix('authentication')
            ->middleware('web')
            ->namespace('App\\Authentication\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

    }

}
