<?php

namespace App\Warehouse\Infrastructure\Persistence\Eloquent\Repositories;

use App\Warehouse\Domain\Orders\Order;
use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;
use App\Warehouse\Infrastructure\Persistence\Eloquent\Orders\EloquentOrder;
use App\Warehouse\Infrastructure\Persistence\Eloquent\Orders\EloquentOrderMapper;
use Illuminate\Support\Collection;

class EloquentOrderRepository implements OrderRepositoryInterface
{

    public function findOneByReferenceAndTenantId(string $reference, int $tenantId): ?Order
    {
        $eloquentOrder = EloquentOrder::query()
            ->where([
                'reference' => $reference,
                'tenant_id' => $tenantId
            ])->first();

        return EloquentOrderMapper::reconstituteEntity($eloquentOrder);
    }

    public function save(Order $order): void
    {
        $model = EloquentOrder::query()
            ->where("id", $order->identity())
            ->take(1)
            ->get()
            ->first();

        EloquentOrderMapper::pruneModel($order, $model);
        EloquentOrderMapper::createOrUpdateModel($order, $model);
    }

    /**
     * @inheritDoc
     */
    public function saveMultiple(Collection $orders): void
    {
        $orders->each(function (Order $order) {
            $this->save($order);
        });
    }

    public function findAllByTenantId(int $tenantId): Collection
    {
        return EloquentOrderMapper::reconstituteEntities(EloquentOrder::all());
    }
}
