<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

/**
 * @property int $id
 * @property string $reference
 * @property string $order_id
 * @property int $tenant_id
 * @property string $processed_date
 */
class EloquentBackorder extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'backorders';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;

    protected $guarded = [];
    protected $casts = [];
    protected $with = [];

    public function orderLines()
    {
        return $this->hasMany(EloquentOrderLine::class, 'backorder_id', 'id');
    }
}
