<?php

namespace App\Inventory\Infrastructure\Persistence\InMemory\Repositories;

use App\Inventory\Domain\Products\Product;
use App\Inventory\Domain\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class InMemoryCollectionProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Collection
     */
    private Collection $products;

    public function __construct()
    {
        $this->products = collect();
    }

    public function getStock(string $productCode, int $tenantId): int
    {
        $product = $this->findByProductCodeAndTenantId($productCode, $tenantId);
        return $product->stock();
    }

    public function increaseStock(string $productCode, int $amount, int $tenantId): Product
    {
        $this->products->transform(function (Product $product) use ($productCode, $amount, $tenantId) {
            if ($product->productCode() === $productCode && $product->tenantId() === $tenantId)
            {
                $product->increaseStock($amount);
            }

            return $product;
        });

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function decreaseStock(string $productCode, int $amount, int $tenantId): Product
    {
        $this->products->transform(function (Product $product) use ($productCode, $amount, $tenantId) {
              if ($product->productCode() === $productCode && $product->tenantId() === $tenantId)
              {
                  $product->decreaseStock($amount);
              }

              return $product;
        });

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function findByProductCodeAndTenantId(string $productCode, int $tenantId): ?Product
    {
        return $this->products->first(function (Product $product) use ($productCode, $tenantId) {
                return $product->productCode() === $productCode && $product->tenantId() === $tenantId;
        });
    }

    public function save(Product $product): void
    {
        $this->products->push($product);
    }

    public function updateStock(string $productCode, int $amount, int $tenantId): Product
    {
        $this->products->transform(function (Product $product) use ($productCode, $amount, $tenantId) {
                if ($product->productCode() === $productCode && $product->tenantId() === $tenantId)
                {
                    $product->changeStock($amount);
                }

                return $product;
        });

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function saveMultiple(Collection $products): void
    {
        $this->products = $this->products->merge($products);
    }

    public function findAllByTenantId(int $tenantId): Collection
    {
        return $this->products->filter(function (Product $product) use ($tenantId) {
            return $product->tenantId() === $tenantId;
        });
    }
}
