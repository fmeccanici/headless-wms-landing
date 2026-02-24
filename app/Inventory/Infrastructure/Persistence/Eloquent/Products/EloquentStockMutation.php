<?php

namespace App\Inventory\Infrastructure\Persistence\Eloquent\Products;

/**
 * @property int $mutation
 * @property string $product_code
 * @property int $tenant_id
 */
class EloquentStockMutation extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "stock_mutations";
    protected $guarded = [];
}
