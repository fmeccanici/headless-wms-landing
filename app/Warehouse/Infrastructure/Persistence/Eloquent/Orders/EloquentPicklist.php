<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;


/**
 * @property int $id
 * @property string $reference
 * @property int $tenant_id
 * @property string $order_id
 */
class EloquentPicklist extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'picklists';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;

    protected $guarded = [];
    protected $casts = [];
    protected $with = [];

    public function orderLines()
    {
        return $this->hasMany(EloquentOrderLine::class, 'picklist_id');
    }
}
