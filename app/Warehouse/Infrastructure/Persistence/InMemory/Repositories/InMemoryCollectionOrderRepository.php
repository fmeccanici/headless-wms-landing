<?php

namespace App\Warehouse\Infrastructure\Persistence\InMemory\Repositories;

use App\Warehouse\Domain\Orders\Order;
use Illuminate\Support\Collection;

class InMemoryCollectionOrderRepository implements \App\Warehouse\Domain\Repositories\OrderRepositoryInterface
{
    /**
     * @var \Illuminate\Support\Collection<Order>
     */
    private \Illuminate\Support\Collection $orders;

    public function __construct()
    {
        $this->orders = collect();
    }

    public function findOneByReferenceAndTenantId(string $reference, int $tenantId): ?Order
    {
        return $this->orders->first(function (Order $order) use ($reference, $tenantId) {
                return $order->reference() === $reference && $order->tenantId() === $tenantId;
        });
    }

    public function save(Order $order): void
    {
        $this->orders->push($order);
    }

    public function saveMultiple(Collection $orders): void
    {
        $this->orders = $this->orders->merge($orders);
    }

    public function findAllByTenantId(int $tenantId): Collection
    {
        return $this->orders->filter(function (Order $order) use ($tenantId) {
            return $order->tenantId() === $tenantId;
        });
    }
}
