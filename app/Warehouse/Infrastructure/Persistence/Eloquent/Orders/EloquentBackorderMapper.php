<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Orders;

use App\SharedKernel\Common\EntityMapperTrait;
use App\SharedKernel\Common\ModelMapperTrait;
use App\SharedKernel\Common\ReflectionClassCache;
use App\Warehouse\Domain\Backorders\Backorder;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Carbon\CarbonImmutable;
use Exception;
use Illuminate\Support\Facades\App;

class EloquentBackorderMapper extends Backorder
{
    use EntityMapperTrait;
    use ModelMapperTrait;

    public static function reconstituteEntityCore(EloquentBackorder $model): ?Backorder
    {
        $backorderClass = ReflectionClassCache::getReflectionClass(Backorder::class);

        /** @var Backorder $entity */
        $entity = $backorderClass->newInstanceWithoutConstructor();

        $entity->id = $model->id;
        $entity->reference = $model->reference;
        $entity->parentId = $model->order_id;
        $entity->tenantId = $model->tenant_id;
        $entity->processedDate = $model->processed_date ? CarbonImmutable::parse($model->processed_date) : null;
        $entity->inventoryService = App::make(InventoryServiceInterface::class);

        $entity->orderLines = EloquentOrderLineMapper::reconstituteEntities($model->orderLines);
        return $entity;
    }

    /**
     * @param Backorder $entity
     * @return void
     * @throws Exception
     */
    protected static function createModelCore(Backorder $entity): void
    {
        $model = new EloquentBackorder();

        $model->id = $entity->id;
        $model->reference = $entity->reference;
        $model->tenant_id = $entity->tenantId;
        $model->processed_date = $entity->processedDate?->toDateTimeString();
        $model->order_id = $entity->parentId;

        $model->save();
        $entity->setIdentity($model->id);

        // mapToModel hasOne's

        // mapToModels hasMany's
        $eloquentOrderLines = EloquentOrderLine::query();

        foreach ($entity->orderLines() as $orderLine)
        {
            $eloquentOrderLines = $eloquentOrderLines->orWhere('id', $orderLine->identity());
        }

        $eloquentOrderLines = $eloquentOrderLines->get();

        EloquentOrderLineMapper::createOrUpdateModels($entity->orderLines, $eloquentOrderLines);
    }

    /**
     * @param Backorder $entity
     * @param EloquentBackorder $model
     * @return void
     * @throws Exception
     */
    protected static function updateModelCore(Backorder $entity, EloquentBackorder $model): void
    {
        $model->id = $entity->id;
        $model->reference = $entity->reference;
        $model->order_id = $entity->parentId;
        $model->tenant_id = $entity->tenantId;
        $model->processed_date = $entity->processedDate?->toDateTimeString();

        $model->save();
        $entity->setIdentity($model->id);

        // createOrUpdateModel hasOne's

        // createOrUpdateModels hasMany's
        EloquentOrderLineMapper::createOrUpdateModels($entity->orderLines, $model->orderLines);
    }

    /**
     * @param EloquentBackorder $model
     * @return void
     * @throws Exception
     */
    protected static function deleteModelCore(EloquentBackorder $model): void
    {
        // purgeModel hasOne's

        // purgeModels hasMany's
        EloquentOrderLineMapper::deleteModels($model->orderLines);

        $model->delete();
    }

    /**
     * @param Backorder $entity
     * @param EloquentBackorder $model
     * @return void
     * @throws Exception
     */
    protected static function pruneModelCore(Backorder $entity, EloquentBackorder $model): void
    {
        // pruneModel hasOne's

        // pruneModels hasMany's
        EloquentOrderLineMapper::pruneModels($entity->orderLines, $model->orderLines);
    }
}
