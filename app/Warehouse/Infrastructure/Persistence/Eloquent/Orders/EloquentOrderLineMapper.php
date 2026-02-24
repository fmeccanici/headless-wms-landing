<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use App\SharedKernel\Common\EntityMapperTrait;
use App\SharedKernel\Common\ModelMapperTrait;
use App\SharedKernel\Common\ReflectionClassCache;
use App\Warehouse\Domain\Orders\OrderLine;
use App\Warehouse\Domain\Products\Product;
use Exception;
use ReflectionException;

class EloquentOrderLineMapper extends OrderLine
{
    use EntityMapperTrait;
    use ModelMapperTrait;

    /**
     * @param EloquentOrderLine $model
     * @return OrderLine
     * @throws ReflectionException|Exception
     */
    protected static function reconstituteEntityCore(EloquentOrderLine $model): OrderLine
    {
        $orderLineClass = ReflectionClassCache::getReflectionClass(OrderLine::class);
        /** @var OrderLine $entity */
        $entity = $orderLineClass->newInstanceWithoutConstructor();

        // TODO: Map attributes
        $entity->id = $model->id;
        $entity->orderId = $model->order_id;
        $entity->picklistId = $model->picklist_id;
        $entity->backorderId = $model->backorder_id;
        $entity->quantity = $model->quantity;
        $entity->quantityPicked = $model->quantity_picked;
        $entity->product = new Product($model->product_code);

        // mapToEntity hasOne's

        // mapToEntities hasMany's

        return $entity;
    }

    /**
     * @param OrderLine $entity
     * @return void
     * @throws Exception
     */
    protected static function createModelCore(OrderLine $entity): void
    {
        $model = new EloquentOrderLine();

        $model->id = $entity->id;
        $model->order_id = $entity->orderId;
        $model->picklist_id = $entity->picklistId;
        $model->backorder_id = $entity->backorderId;
        $model->quantity = $entity->quantity;
        $model->product_code = $entity->product->productCode();
        $model->quantity_picked = $entity->quantityPicked;

        $model->save();
        $entity->setIdentity($model->id);

        // mapToModel hasOne's

        // mapToModels hasMany's
    }

    /**
     * @param OrderLine $entity
     * @param EloquentOrderLine $model
     * @return void
     * @throws Exception
     */
    protected static function updateModelCore(OrderLine $entity, EloquentOrderLine $model): void
    {
        $model->id = $entity->id;
        $model->order_id = $entity->orderId;
        $model->picklist_id = $entity->picklistId;
        $model->backorder_id = $entity->backorderId;

        $model->quantity = $entity->quantity;
        $model->quantity_picked = $entity->quantityPicked;
        $model->product_code = $entity->product->productCode();

        $model->save();
        $entity->setIdentity($model->id);

        // createOrUpdateModel hasOne's

        // createOrUpdateModels hasMany's
    }

    /**
     * @param EloquentOrderLine $model
     * @return void
     * @throws Exception
     */
    protected static function deleteModelCore(EloquentOrderLine $model): void
    {
        // purgeModel hasOne's

        // purgeModels hasMany's

        $model->delete();
    }
    /**
     * @param OrderLine $entity
     * @param EloquentOrderLine $model
     * @return void
     * @throws Exception
     */
    protected static function pruneModelCore(OrderLine $entity, EloquentOrderLine $model): void
    {
        // pruneModel hasOne's

        // pruneModel hasMany's
    }
}
