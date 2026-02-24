<?php

namespace App\Warehouse\Domain\Backorders;

use App\SharedKernel\DDD\AggregateRoot;
use App\Warehouse\Domain\Orders\OrderLine;
use App\Warehouse\Domain\Picklists\Picklist;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Backorder extends AggregateRoot implements Arrayable
{
    use HasFactory;

    protected string $reference;

    /**
     * @var Collection<OrderLine>
     */
    protected Collection $orderLines;
    protected int $tenantId;
    protected InventoryServiceInterface $inventoryService;
    protected ?CarbonImmutable $processedDate;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (sizeof($attributes) > 0)
        {
            $reference = $attributes["reference"];
            $orderLines = $attributes["order_lines"];
            $tenantId = $attributes["tenant_id"];
            $inventoryService = Arr::get($attributes, 'inventory_service');

            $this->reference = $reference;
            $this->orderLines = $orderLines;
            $this->tenantId = $tenantId;
            $this->inventoryService = $inventoryService;
            $this->processedDate = null;
        }
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function orderLines(): Collection
    {
        return $this->orderLines;
    }

    public function process(): ?Picklist
    {
        $onStockOrderLines = $this->onStockOrderLines();
        $outOfStockOrderLines = $this->outOfStockOrderLines();

        $this->orderLines = $outOfStockOrderLines;

        if ($this->orderLines->isEmpty())
        {
            $this->processedDate = CarbonImmutable::now();
        } else {
            return null;
        }

        $onStockOrderLines->transform(function (OrderLine $orderLine) {
                $orderLine->setBackorderId(null);
                return $orderLine;
        });

        return Picklist::factory()->make([
            'tenant_id' => $this->tenantId,
            'order_lines' => $onStockOrderLines,
        ]);
    }

    public function processed(): bool
    {
        return $this->processedDate !== null;
    }

    public function processedDate(): ?CarbonImmutable
    {
        return $this->processedDate;
    }

    private function onStockOrderLines(): Collection
    {
        return $this->orderLines()->filter(function (OrderLine $orderLine) {
            $availableStock = $this->inventoryService->getStock($orderLine->product()->productCode(), $this->tenantId);

            if ($availableStock >= $orderLine->quantity())
            {
                return true;
            }

            return false;
        });
    }

    private function outOfStockOrderLines(): Collection
    {
        return $this->orderLines()->filter(function (OrderLine $orderLine) {
            $availableStock = $this->inventoryService->getStock($orderLine->product()->productCode(), $this->tenantId);

            if ($availableStock >= $orderLine->quantity())
            {
                return false;
            }

            return true;
        });
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        $this->orderLines->each(fn(OrderLine $x) => $x->setOrderId($this->parentIdentity()));
        $this->orderLines->each(fn(OrderLine $x) => $x->setBackorderId($id));
    }

    protected static function newFactory()
    {
        return BackorderFactory::new();
    }

    public function newCollection(array $orders = [])
    {
        return new Collection($orders);
    }

    public function toArray()
    {
        return [
            'reference' => $this->reference,
            'order_lines' => $this->orderLines->toArray(),
        ];
    }

}
