<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $reference
 * @property int $id
 * @property string $customer_number
 * @property bool $is_guest_order
 * @property ?int $tenant_id
 */
class EloquentOrder extends Model
{
    protected $table = "orders";

    public function orderLines()
    {
        return $this->hasMany(EloquentOrderLine::class, 'order_id', 'id');
    }

    public function picklists()
    {
        return $this->hasMany(EloquentPicklist::class, 'order_id');
    }

    public function backorders()
    {
        return $this->hasMany(EloquentBackorder::class, 'order_id');
    }
}
