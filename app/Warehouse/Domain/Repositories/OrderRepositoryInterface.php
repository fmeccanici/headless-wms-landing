<?php

namespace App\Warehouse\Domain\Repositories;

use App\Warehouse\Domain\Orders\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function findOneByReferenceAndTenantId(string $reference, int $tenantId): ?Order;
    public function save(Order $order): void;

    /**
     * @param Collection<Order> $orders
     * @return void
     */
    public function saveMultiple(Collection $orders): void;

    public function findAllByTenantId(int $tenantId): Collection;
}
