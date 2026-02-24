<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use App\SharedKernel\Common\EntityMapperTrait;
use App\SharedKernel\Common\ModelMapperTrait;
use App\SharedKernel\Common\ReflectionClassCache;
use App\Warehouse\Domain\Picklists\Picklist;
use Exception;
use ReflectionException;

class EloquentPicklistMapper extends Picklist
{
    use EntityMapperTrait;
    use ModelMapperTrait;

    /**
     * @param EloquentPicklist $model
     * @return Picklist
     * @throws ReflectionException|Exception
     */
    protected static function reconstituteEntityCore(EloquentPicklist $model): Picklist
    {
        $productClass = ReflectionClassCache::getReflectionClass(Picklist::class);
        /** @var Picklist $entity */
        $entity = $productClass->newInstanceWithoutConstructor();

        $entity->id = $model->id;
        $entity->reference = $model->reference;
        $entity->tenantId = $model->tenant_id;
        $entity->parentId = (int) $model->order_id;

        // mapToEntity hasOne's

        // mapToEntities hasMany's
        $entity->orderLines = EloquentOrderLineMapper::reconstituteEntities($model->orderLines);

        return $entity;
    }

    /**
     * @param Picklist $entity
     * @return void
     * @throws Exception
     */
    protected static function createModelCore(Picklist $entity): void
    {
        $model = new EloquentPicklist();

        $model->id = $entity->id;
        $model->reference = $entity->reference;
        $model->tenant_id = $entity->tenantId;
        $model->order_id = $entity->parentId;

        $model->save();
        $entity->setIdentity($model->id);

        // mapToModel hasOne's

        // mapToModels hasMany's

        // Needed because otherwise it will create a new order line with duplicate primary key
        $eloquentOrderLines = EloquentOrderLine::query();

        foreach ($entity->orderLines() as $orderLine)
        {
            $eloquentOrderLines = $eloquentOrderLines->orWhere('id', $orderLine->identity());
        }

        $eloquentOrderLines = $eloquentOrderLines->get();

        EloquentOrderLineMapper::createOrUpdateModels($entity->orderLines, $eloquentOrderLines);
    }

    /**
     * @param Picklist $entity
     * @param EloquentPicklist $model
     * @return void
     * @throws Exception
     */
    protected static function updateModelCore(Picklist $entity, EloquentPicklist $model): void
    {
        $model->id = $entity->id;
        $model->reference = $entity->reference;
        $model->tenant_id = $entity->tenantId;
        $model->order_id = $entity->parentId;

        $model->save();
        $entity->setIdentity($model->id);

        // createOrUpdateModel hasOne's

        // createOrUpdateModels hasMany's
        EloquentOrderLineMapper::createOrUpdateModels($entity->orderLines, $model->orderLines);
    }

    /**
     * @param EloquentPicklist $model
     * @return void
     * @throws Exception
     */
    protected static function deleteModelCore(EloquentPicklist $model): void
    {
        // purgeModel hasOne's

        // purgeModels hasMany's
        EloquentOrderLineMapper::deleteModels($model->orderLines);

        $model->delete();
    }

    /**
     * @param Picklist $entity
     * @param EloquentPicklist $model
     * @return void
     * @throws Exception
     */
    protected static function pruneModelCore(Picklist $entity, EloquentPicklist $model): void
    {
        // pruneModel hasOne's

        // pruneModels hasMany's
        EloquentOrderLineMapper::pruneModels($entity->orderLines, $model->orderLines);
    }
}
