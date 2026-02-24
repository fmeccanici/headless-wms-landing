<?php

namespace App\Warehouse\Domain\Repositories;

use App\Warehouse\Domain\Picklists\Picklist;
use Illuminate\Support\Collection;

interface PicklistRepositoryInterface
{
    public function findByOrderReferenceAndTenantId(string $orderReference, int $tenantId): Collection;
    public function save(Picklist $picklist): void;
    public function saveMultiple(Collection $picklists): void;
    public function findAllByTenantId(int $tenantId): Collection;
}
