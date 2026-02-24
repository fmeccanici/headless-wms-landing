<?php

use App\Warehouse\Presentation\Http\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/v1/orders/{orderReference}/process', [WarehouseController::class, 'processOrder'])
        ->middleware('auth:sanctum')
        ->name('process-order');
    Route::post('/v1/orders', [WarehouseController::class, 'createOrder'])->name('create-order');
    Route::get('/v1/orders', [WarehouseController::class, 'getAllOrders'])->name('get-all-orders');
    Route::get('/v1/orders/{orderReference}', [WarehouseController::class, 'getOrderByReference'])->name('get-order-by-reference');
    Route::get('/v1/orders/{orderReference}/picklists', [WarehouseController::class, 'getPicklistsForOrder'])->name('get-picklists-for-order');
    Route::get('/v1/orders/{orderReference}/backorders', [WarehouseController::class, 'getBackordersForOrder'])->name('get-backorders-for-order');
    Route::get('/v1/backorders', [WarehouseController::class, 'getAllBackorders'])->name('get-all-backorders');
    Route::get('/v1/backorders/process', [WarehouseController::class, 'processBackorders'])->name('process-backorders');
    Route::get('/v1/picklists', [WarehouseController::class, 'getAllPicklists'])->name('get-all-picklists');
    Route::post('/v1/picklists/{picklistId}/pick-all', [WarehouseController::class, 'pickAllProductFromPicklist'])->name('pick-all-products-from-picklist');
    Route::post('/v1/picklists/{picklistId}/cancel', [WarehouseController::class, 'cancelPicklist'])->name('cancel-picklist');
});

