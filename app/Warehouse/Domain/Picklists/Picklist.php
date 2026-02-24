<?php

namespace App\Warehouse\Domain\Picklists;

use App\SharedKernel\DDD\Entity;
use App\Warehouse\Domain\Orders\OrderLine;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Picklist extends Entity implements Arrayable
{
    use HasFactory;

    protected string $reference;

    /**
     * @var Collection<OrderLine>
     */
    protected Collection $orderLines;
    protected int $tenantId;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (sizeof($attributes) > 0)
        {
            $this->reference = $attributes['reference'];
            $this->orderLines = $attributes['order_lines'];
            $this->tenantId = $attributes['tenant_id'];
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

    public function tenantId(): int
    {
        return $this->tenantId;
    }

    public function fullyPicked(): bool
    {
        $orderLinesFullyPicked = $this->orderLines->filter(function (OrderLine $orderLine) {
            return $orderLine->isFullyPicked();
        });

        return $orderLinesFullyPicked->count() === $this->orderLines->count();
    }

    public function pickAll()
    {
        $this->orderLines->transform(function (OrderLine $orderLine) {
            $orderLine->fullyPick();
            return $orderLine;
        });
    }

    protected static function newFactory()
    {
        return new PicklistFactory();
    }

    public function newCollection(array $picklists = [])
    {
        return new Collection($picklists);
    }

    public function toArray()
    {
        return [
            'reference' => $this->reference,
            'order_lines' => $this->orderLines->toArray(),
        ];
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        $this->orderLines->each(fn(OrderLine $x) => $x->setPicklistId($id));
        $this->orderLines->each(fn(OrderLine $x) => $x->setOrderId($this->parentIdentity()));
    }
}
