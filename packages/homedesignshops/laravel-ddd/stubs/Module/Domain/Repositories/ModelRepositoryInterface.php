<?php


namespace App\Module\Domain\Repositories;


use App\Module\Domain\Model;

interface ModelRepositoryInterface
{
    /**
     * @param int $id
     * @return Model|null
     */
    public function findModel(int $id): ?Model;
}
