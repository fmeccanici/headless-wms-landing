<?php

namespace App\Warehouse\Domain\Orders;

use App\SharedKernel\DDD\Entity;
use App\Warehouse\Domain\Products\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class OrderLine extends Entity implements Arrayable
{
    protected Product $product;
    protected int $quantity;
    protected int $quantityPicked;

    protected int|string|null $orderId = null;
    protected int|string|null $backorderId = null;
    protected int|string|null $picklistId = null;

    /**
     * @param Product $product
     * @param int $quantity
     * @param int $quantityPicked
     */
    public function __construct(Product $product, int $quantity, int $quantityPicked = 0)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->quantityPicked = $quantityPicked;
    }

    public function setOrderId(int|string|null $orderId)
    {
        $this->orderId = $orderId;
    }

    public function setPicklistId(int|string|null $picklistId)
    {
        $this->picklistId = $picklistId;
    }

    public function setBackorderId(int|string|null $backorderId)
    {
        $this->backorderId = $backorderId;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function isFullyPicked(): bool
    {
        return $this->quantity == $this->quantityPicked;
    }

    public function fullyPick()
    {
        $this->quantityPicked = $this->quantity;
    }

    public function toArray()
    {
        return [
            'product_code' => $this->product->productCode(),
            'quantity' => $this->quantity,
            'quantity_picked' => $this->quantityPicked
        ];
    }

    public static function fromArray(array $orderLine)
    {
        $product = new Product($orderLine["product_code"]);
        $quantity = Arr::get($orderLine, 'quantity');
        $quantityPicked = Arr::get($orderLine, 'quantity_picked');

        if ($quantityPicked === null)
        {
            $quantityPicked = 0;
        }

        return new OrderLine($product, $quantity, $quantityPicked);
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        // TODO: Implement cascadeSetIdentity() method.
    }
}
