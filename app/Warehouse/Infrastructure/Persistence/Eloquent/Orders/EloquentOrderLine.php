<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $product_code
 * @property int $quantity
 * @property int $quantity_picked
 * @property int $order_id
 * @property ?int $picklist_id
 * @property ?int $backorder_id
 *
 */
class EloquentOrderLine extends Model
{
    protected $table = "order_lines";
    protected $guarded = [];

}
