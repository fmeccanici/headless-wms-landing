<?php


namespace App\Warehouse\Infrastructure\Providers;

use App\Warehouse\Domain\Repositories\BackorderRepositoryInterface;
use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;
use App\Warehouse\Domain\Repositories\PicklistRepositoryInterface;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use App\Warehouse\Infrastructure\Persistence\Eloquent\Repositories\EloquentBackorderRepository;
use App\Warehouse\Infrastructure\Persistence\Eloquent\Repositories\EloquentOrderRepository;
use App\Warehouse\Infrastructure\Persistence\Eloquent\Repositories\EloquentPicklistRepository;
use App\Warehouse\Infrastructure\Services\InventoryService;
use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class WarehouseServiceProvider extends ServiceProvider
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
        $this->registerWarehouseRoutes();
        $this->registerDoctrineEntityManager();
        $this->loadMigrationsFrom([
            app_path("Warehouse/Infrastructure/Persistence/Eloquent/Migrations")
        ]);

        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->bind(PicklistRepositoryInterface::class, EloquentPicklistRepository::class);
        $this->app->bind(InventoryServiceInterface::class, InventoryService::class);
        $this->app->bind(BackorderRepositoryInterface::class, EloquentBackorderRepository::class);
    }

    /**
     * Registers the warehouse routes
     */
    protected function registerWarehouseRoutes(): void
    {
        Route::prefix('warehouse')
            ->middleware('web')
            ->namespace('App\\Warehouse\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/')
            ->middleware('api')
            ->namespace('App\\Warehouse\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}
