<?php

use App\Inventory\Presentation\Http\Api\InventoryController;
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
    Route::get("/v1/products/{productCode}/stock", [InventoryController::class, "getProductStock"])->name('get-product-stock');
    Route::post("/v1/products/{productCode}/stock", [InventoryController::class, "changeProductStock"])->name('change-product-stock');
    Route::post("/v1/products", [InventoryController::class, "createProduct"])->name('create-product');
    Route::get("/v1/products", [InventoryController::class, "getAllProducts"])->name('get-all-products');
});
