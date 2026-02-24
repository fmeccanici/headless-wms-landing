<?php

namespace App\Warehouse\Domain\Repositories;

use App\Warehouse\Domain\Backorders\Backorder;
use Illuminate\Support\Collection;

interface BackorderRepositoryInterface
{
    public function findByOrderReferenceAndTenantId(string $orderReference, int $tenantId): Collection;
    public function save(Backorder $backorder): void;
    public function saveMultiple(Collection $backorders): void;
    public function findAllByTenantId(int $tenantId): Collection;
    public function delete(Backorder $backorder): void;
}
