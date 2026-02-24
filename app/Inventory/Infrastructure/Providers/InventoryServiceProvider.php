<?php


namespace App\Inventory\Infrastructure\Providers;

use App\Inventory\Domain\Repositories\ProductRepositoryInterface;
use App\Inventory\Infrastructure\Persistence\Eloquent\Repositories\EloquentProductRepository;
use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class InventoryServiceProvider extends ServiceProvider
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
        $this->registerInventoryRoutes();
        $this->registerDoctrineEntityManager();

        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);

        $this->loadMigrationsFrom([
            app_path("Inventory/Infrastructure/Persistence/Eloquent/Migrations")
        ]);

    }

    /**
     * Registers the inventory routes
     */
    protected function registerInventoryRoutes(): void
    {
        Route::prefix('inventory')
            ->middleware('web')
            ->namespace('App\\Inventory\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/')
            ->middleware('api')
            ->namespace('App\\Inventory\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}
