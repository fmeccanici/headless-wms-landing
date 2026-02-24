<?php

namespace App\Inventory\Infrastructure\Persistence\Eloquent\Products;

/**
 * @property string $product_code
 * @property int $id
 */
class EloquentProduct extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "products";
    protected $guarded = [];
}
