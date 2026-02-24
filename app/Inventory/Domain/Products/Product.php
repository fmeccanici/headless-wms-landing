<?php

namespace App\Inventory\Domain\Products;

use App\SharedKernel\DDD\Entity;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Product extends Entity implements Arrayable
{
    use HasFactory;

    protected string $productCode;
    protected int $stock;
    protected ?int $tenantId;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if (sizeof($attributes) > 0)
        {
            $productCode = $attributes["product_code"];
            $stock = $attributes["stock"];
            $tenantId = $attributes["tenant_id"];

            $this->tenantId = $tenantId;
            $this->stock = $stock;
            $this->productCode = $productCode;
        }
    }

    public function tenantId(): ?int
    {
        return $this->tenantId;
    }

    public function productCode(): string
    {
        return $this->productCode;
    }

    public function stock(): int
    {
        return $this->stock;
    }

    public function decreaseStock(int $quantity)
    {
        $this->stock -= $quantity;
    }

    public function increaseStock(int $quantity)
    {
        $this->stock += $quantity;
    }

    public function changeStock(int $quantity)
    {
        $this->stock = $quantity;
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function newCollection(array $orders = [])
    {
        return new Collection($orders);
    }

    public function toArray()
    {
        return [
            "product_code" => $this->productCode,
            "stock" => $this->stock
        ];
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        // Nothing to do
    }
}
