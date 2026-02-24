<?php

namespace App\SharedKernel\Common;

use Exception;
use Illuminate\Support\Collection;

/**
 * @template TModel
 * @template TEntity
 */
trait ModelMapperTrait
{
    /*
    |--------------------------------------------------------------------------
    | createModels / createModel / createModelCore
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected static function createModelCore($entity): void
    {
        throw new Exception("trait method createModelCore MUST be reimplemented in the using class");
    }

    /**
     * @param ?TEntity $entity
     * @return void
     * @throws Exception
     */
    public static function createModel(mixed $entity): void
    {
        optional($entity, function ($entity) {
            static::createModelCore($entity);
        });
    }

    /**
     * @param Collection<TEntity> $entities
     * @return void
     * @throws Exception
     */
    public static function createModels(Collection $entities): void
    {
        $entities->each(function ($entity) {
            static::createModel($entity);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | createOrUpdateModels / createOrUpdateModel / updateModelCore
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected static function updateModelCore($entity, $model): void
    {
        throw new Exception("trait method updateModelCore MUST be reimplemented in the using class");
    }

    /**
     * @param ?TEntity $entity
     * @param ?TModel $model
     * @return void
     * @throws Exception
     */
    public static function createOrUpdateModel(mixed $entity, mixed $model): void
    {
        optional($entity, function ($entity) use ($model) {
            if (! $model) {
                static::createModel($entity);
            }
            else {
                static::updateModelCore($entity, $model);
            }
        });
    }

    /**
     * @param Collection<TEntity> $entities
     * @param Collection<TModel> $models
     * @return void
     * @throws Exception
     */
    public static function createOrUpdateModels(Collection $entities, Collection $models): void
    {
        $entities->each(function ($entity) use ($models) {
            $model = $models->first(function ($model) use ($entity) {
                $keyName = $model->getKeyName();
                return $entity->identity() === $model->{$keyName};
            });

            static::createOrUpdateModel($entity, $model);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | deleteModels / deleteModel / deleteModelCore
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected static function deleteModelCore($model): void
    {
        throw new Exception("trait method deleteModel MUST be reimplemented in the using class");
    }

    /**
     * @param ?TModel $model
     * @return void
     * @throws Exception
     */
    public static function deleteModel(mixed $model): void
    {
        optional($model, function ($model) {
            static::deleteModelCore($model);
        });
    }

    /**
     * @param Collection<TModel> $models
     * @return void
     * @throws Exception
     */
    public static function deleteModels(Collection $models): void
    {
        $models->each(function ($model) {
            static::deleteModel($model);
        });
    }

    /*
    |--------------------------------------------------------------------------
    |  pruneModels / pruneModel / pruneModelCore
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected static function pruneModelCore(mixed $entity, mixed $model): void
    {
        throw new Exception("trait method pruneModelCore MUST be reimplemented in the using class");
    }

    /**
     * @param ?TEntity $entity
     * @param ?TModel $model
     * @return void
     * @throws Exception
     */
    public static function pruneModel(mixed $entity, mixed $model): void
    {
        optional($model, function ($model) use ($entity) {
            if (! $entity) {
                static::deleteModel($model);
            }
            else {
                static::pruneModelCore($entity, $model);
            }
        });
    }

    /**
     * @param Collection<TEntity> $entities
     * @param Collection<TModel> $models
     * @return void
     * @throws Exception
     */
    public static function pruneModels(Collection $entities, Collection $models): void
    {
        $models->each(function ($model) use ($entities) {
            $entity = $entities->first(function ($entity) use ($model) {
                $keyName = $model->getKeyName();
                return $model->{$keyName} === $entity->identity();
            });

            static::pruneModel($entity, $model);
        });
    }
}
