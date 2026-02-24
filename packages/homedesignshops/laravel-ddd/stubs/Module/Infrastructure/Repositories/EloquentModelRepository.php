<?php


namespace App\Module\Infrastructure\Repositories;


use App\Module\Domain\Repositories\ModelRepositoryInterface;
use App\Module\Domain\Model;

class EloquentModelRepository implements ModelRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findModel(int $id): ?Model
    {
        return Model::find($id);
    }
}
