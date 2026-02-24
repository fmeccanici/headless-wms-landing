<?php

namespace App\Warehouse\Domain\Orders;

use App\SharedKernel\DDD\Entity;
use App\Warehouse\Domain\Backorders\Backorder;
use App\Warehouse\Domain\Exceptions\NonGuestOrderWithoutCustomerNumberException;
use App\Warehouse\Domain\Picklists\Picklist;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class Order extends Entity implements Arrayable
{
    use HasFactory;

    protected string $reference;

    /**
     * @var Collection<OrderLine>
     */
    protected Collection $orderLines;
    protected bool $isGuestOrder;
    protected ?string $customerNumber;
    protected ?int $tenantId;

    protected Collection $backorders;
    protected Collection $picklists;

    protected InventoryServiceInterface $inventoryService;

    /**
     * @throws NonGuestOrderWithoutCustomerNumberException
     */
    private function validate($reference, $orderLines, $customerNumber, $isGuestOrder, $picklists, $backorders)
    {
        if ($isGuestOrder === false && $customerNumber === null)
        {
            throw new NonGuestOrderWithoutCustomerNumberException("Customer number should be specified with non guest order");
        }
    }

    /**
     * @param array $attributes
     * @throws NonGuestOrderWithoutCustomerNumberException
     */
    public function __construct(array $attributes)
    {
        if (sizeof($attributes) > 0)
        {
            $reference = $attributes["reference"];
            $orderLines = $attributes["order_lines"];
            $picklists = Arr::get($attributes, 'picklists');
            $backorders = Arr::get($attributes, 'backorders');
            $customerNumber = $attributes["customer_number"];
            $isGuestOrder = $attributes["is_guest_order"];
            $tenantId = $attributes["tenant_id"];

            $this->inventoryService = App::make(InventoryServiceInterface::class);

            if ($picklists === null)
            {
                $picklists = collect();
            }

            if ($backorders === null)
            {
                $backorders = collect();
            }

            $this->validate($reference, $orderLines, $customerNumber, $isGuestOrder, $picklists, $backorders);

            $this->reference = $reference;
            $this->orderLines = $orderLines;
            $this->picklists = $picklists;
            $this->backorders = $backorders;
            $this->customerNumber = $customerNumber;
            $this->isGuestOrder = $isGuestOrder;
            $this->tenantId = $tenantId;
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

    public function backorders(): Collection
    {
        return $this->backorders;
    }

    public function picklists(): Collection
    {
        return $this->picklists;
    }

    public function createBackorder(Collection $orderLines)
    {
        $orderLines = $orderLines->map(function (OrderLine $orderLine) {
            $orderLine->setPicklistId(null);
            return $orderLine;
        });

        $backorder = Backorder::factory()->make([
            "reference" => uniqid(),
            "order_lines" => $orderLines,
            "tenant_id" => $this->tenantId,
        ]);

        $this->backorders->push($backorder);
    }

    public function createPicklist(Collection $orderLines): Picklist
    {
        $orderLines = $orderLines->map(function (OrderLine $orderLine) {
             $orderLine->setBackorderId(null);
             return $orderLine;
        });

        $picklist = Picklist::factory()->make([
            "reference" => uniqid(),
            "order_lines" => $orderLines,
            "order_reference" => $this->reference,
            "tenant_id" => $this->tenantId,
        ]);

        $this->picklists->push($picklist);

        return $picklist;
    }

    public function fullyPickPicklist(string $picklistId): Picklist
    {
        $picklist = $this->picklist($picklistId);
        $picklist->pickAll();

        return $picklist;
    }

    public function picklist(string $picklistId): ?Picklist
    {
        return $this->picklists->filter(function (Picklist $picklist) use ($picklistId) {
            return $picklist->reference() == $picklistId || $picklist->identity() == $picklistId;
        })->first();
    }

    public function customerNumber(): ?string
    {
        return $this->customerNumber;
    }

    public function isGuestOrder(): bool
    {
        return $this->isGuestOrder;
    }

    public function tenantId(): ?int
    {
        return $this->tenantId;
    }

    public function cancelPicklist(string $picklistId)
    {
        $picklist = $this->picklist($picklistId);

        $picklist->orderLines()->each(function (OrderLine $orderLine) {
            $this->inventoryService->adjustStock($orderLine->product()->productCode(), $orderLine->quantity(), $this->tenantId);
        });

        $this->removePicklist($picklistId);
    }

    protected function removePicklist(string $picklistId)
    {
        $this->picklists = $this->picklists->filter(function (Picklist $picklist) use ($picklistId) {
            return $picklist->identity() != $picklistId && $picklist->reference() != $picklistId;
        });
    }

    public function processBackorders()
    {
        $picklists = $this->backorders->map(function (Backorder $backorder) {
            $picklist = $backorder->process();

            if ($picklist !== null)
            {
                $this->removeBackorder($backorder);
            }

            return $picklist;
        })->filter(function ($picklists) {
            return $picklists !== null;
        });

        $this->picklists = $this->picklists->merge($picklists);
    }

    public function removeBackorder(Backorder $backorder)
    {
        $backorderId = $backorder->identity();
        $this->backorders = $this->backorders->filter(function (Backorder $backorder) use ($backorderId) {
            return $backorder->identity() !== $backorderId;
        });
    }

    public function toArray(bool $withPicklists = false, bool $withBackorders = false)
    {
        $array = [
            "reference" => $this->reference,
            "customer_number" => $this->customerNumber,
            "is_guest_order" => $this->isGuestOrder,
            "tenant_id" => $this->tenantId,
            "order_lines" => $this->orderLines->toArray()
        ];

        if ($withBackorders)
        {
            $array['backorders'] = $this->backorders->toArray();
        }

        if ($withPicklists)
        {
            $array['picklists'] = $this->picklists->toArray();
        }

        return $array;
    }

    public static function fromArray(array $order, bool $withPicklists = false, bool $withBackorders = false): Order
    {
        $reference = $order["reference"];
        $orderLines = collect($order["order_lines"]);
        $isGuestOrder = $order["is_guest_order"];
        $customerNumber = $order["customer_number"];
        $tenantId = $order["tenant_id"];

        if ($withPicklists)
        {
            $picklists = Arr::get($order, 'picklists');
        } else {
            $picklists = collect();
        }

        if ($withBackorders)
        {
            $backorders = Arr::get($order, 'backorders');
        } else {
            $backorders = collect();
        }

        $orderLines = $orderLines->map(function (array $orderLine) {
                return OrderLine::fromArray($orderLine);
        });

        return new Order([
            "reference" => $reference,
            "order_lines" => $orderLines,
            "is_guest_order" => $isGuestOrder,
            "customer_number" => $customerNumber,
            "tenant_id" => $tenantId,
            'backorders' => $backorders,
            'picklists' => $picklists
        ]);
    }

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function newCollection(array $orders = [])
    {
        return new Collection($orders);
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        $this->orderLines->each(fn(OrderLine $x) => $x->setOrderId($id));
        $this->picklists->each(fn(Picklist $x) => $x->setParentIdentity($id));
        $this->backorders->each(fn(Backorder $x) => $x->setParentIdentity($id));
    }
}
