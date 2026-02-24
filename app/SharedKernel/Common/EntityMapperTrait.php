<?php

namespace App\SharedKernel\Common;


use Exception;
use Illuminate\Support\Collection;

/**
 * @template TModel
 * @template TEntity
 */
trait EntityMapperTrait
{
    /*
    |--------------------------------------------------------------------------
    | reconstituteEntities / reconstituteEntity / reconstituteEntityCore
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    protected static function reconstituteEntityCore($model)
    {
        throw new Exception("trait method reconstituteEntityCore MUST be reimplemented in the using class");
    }

    /**
     * @param ?TModel $model
     * @return ?TEntity
     * @throws Exception
     */
    public static function reconstituteEntity(mixed $model)
    {
        return optional($model, function ($model) {
            return static::reconstituteEntityCore($model);
        });
    }

    /**
     * @param Collection<TModel> $models
     * @return Collection<TEntity>
     * @throws Exception
     */
    public static function reconstituteEntities(Collection $models): Collection
    {
        return $models->map(function ($model) {
                return static::reconstituteEntity($model);
        });
    }

}
