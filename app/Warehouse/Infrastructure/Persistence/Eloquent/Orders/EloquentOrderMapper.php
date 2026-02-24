<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use App\SharedKernel\Common\EntityMapperTrait;
use App\SharedKernel\Common\ModelMapperTrait;
use App\SharedKernel\Common\ReflectionClassCache;
use App\Warehouse\Domain\Orders\Order;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Exception;
use Illuminate\Support\Facades\App;

class EloquentOrderMapper extends Order
{
    use EntityMapperTrait;
    use ModelMapperTrait;

    public static function reconstituteEntityCore(EloquentOrder $model): ?Order
    {
        $orderClass = ReflectionClassCache::getReflectionClass(Order::class);

        /** @var Order $entity */
        $entity = $orderClass->newInstanceWithoutConstructor();

        $entity->id = $model->id;
        $entity->reference = $model->reference;
        $entity->customerNumber = $model->customer_number;
        $entity->isGuestOrder = $model->is_guest_order;
        $entity->tenantId = $model->tenant_id;

        $entity->orderLines = EloquentOrderLineMapper::reconstituteEntities($model->orderLines);

        $entity->picklists = $model->picklists->isEmpty() ? collect() : EloquentPicklistMapper::reconstituteEntities($model->picklists);
        $entity->backorders = $model->backorders->isEmpty() ? collect() : EloquentBackorderMapper::reconstituteEntities($model->backorders);
        $entity->inventoryService = App::make(InventoryServiceInterface::class);
        return $entity;
    }

    /**
     * @param Order $entity
     * @return void
     * @throws Exception
     */
    protected static function createModelCore(Order $entity): void
    {
        $model = new EloquentOrder();

        // TODO: Map attributes
        $model->id = $entity->id;
        $model->customer_number = $entity->customerNumber;
        $model->reference = $entity->reference;
        $model->is_guest_order = $entity->isGuestOrder;
        $model->tenant_id = $entity->tenantId;

        // TODO: Save model and set identity
        $model->save();
        $entity->setIdentity($model->id);

        // mapToModel hasOne's

        // mapToModels hasMany's
        EloquentOrderLineMapper::createModels($entity->orderLines);
        EloquentPicklistMapper::createModels($entity->picklists);
        EloquentBackorderMapper::createModels($entity->backorders);
    }

    /**
     * @param Order $entity
     * @param EloquentOrder $model
     * @return void
     * @throws Exception
     */
    protected static function updateModelCore(Order $entity, EloquentOrder $model): void
    {
        // TODO: Map attributes
        $model->id = $entity->id;
        $model->customer_number = $entity->customerNumber;
        $model->reference = $entity->reference;
        $model->is_guest_order = $entity->isGuestOrder;
        $model->tenant_id = $entity->tenantId;

        $model->save();
        $entity->setIdentity($model->id);

        // createOrUpdateModel hasOne's

        // createOrUpdateModels hasMany's
        EloquentOrderLineMapper::createOrUpdateModels($entity->orderLines, $model->orderLines);
        EloquentPicklistMapper::createOrUpdateModels($entity->picklists, $model->picklists);
        EloquentBackorderMapper::createOrUpdateModels($entity->backorders, $model->backorders);
    }

    /**
     * @param EloquentOrder $model
     * @return void
     * @throws Exception
     */
    protected static function deleteModelCore(EloquentOrder $model): void
    {
        // purgeModel hasOne's

        // purgeModels hasMany's
        EloquentOrderLineMapper::deleteModels($model->orderLines);
        EloquentPicklistMapper::deleteModels($model->picklists);
        EloquentBackorderMapper::deleteModels($model->backorders);

        $model->delete();
    }

    /**
     * @param Order $entity
     * @param EloquentOrder $model
     * @return void
     * @throws Exception
     */
    protected static function pruneModelCore(Order $entity, EloquentOrder $model): void
    {
        // pruneModel hasOne's

        // pruneModels hasMany's
        EloquentOrderLineMapper::pruneModels($entity->orderLines, $model->orderLines);
        EloquentBackorderMapper::pruneModels($entity->backorders, $model->backorders);
        EloquentPicklistMapper::pruneModels($entity->picklists, $model->picklists);
    }
}
