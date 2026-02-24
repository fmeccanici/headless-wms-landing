<?php

namespace App\Inventory\Infrastructure\Persistence\Eloquent\Repositories;

use App\Inventory\Domain\Products\Product;
use App\Inventory\Infrastructure\Persistence\Eloquent\Products\EloquentProduct;
use App\Inventory\Infrastructure\Persistence\Eloquent\Products\EloquentStockMutation;
use Illuminate\Support\Collection;

class EloquentProductRepository implements \App\Inventory\Domain\Repositories\ProductRepositoryInterface
{

    public function getStock(string $productCode, int $tenantId): int
    {
        return $this->findByProductCodeAndTenantId($productCode, $tenantId)->stock();
    }

    public function increaseStock(string $productCode, int $amount, int $tenantId): Product
    {
        $eloquentProduct = EloquentProduct::where('product_code', $productCode)->first();
        $eloquentStockMutation = new EloquentStockMutation([
            'product_id' => $eloquentProduct->id,
            'mutation' => $amount,
            'tenant_id' => $tenantId
        ]);

        $eloquentStockMutation->save();

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function decreaseStock(string $productCode, int $amount, int $tenantId): Product
    {
        $eloquentProduct = EloquentProduct::where('product_code', $productCode)->first();
        $eloquentStockMutation = new EloquentStockMutation([
            'product_id' => $eloquentProduct->id,
            'mutation' => - $amount,
            'tenant_id' => $tenantId
        ]);

        $eloquentStockMutation->save();

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function findByProductCodeAndTenantId(string $productCode, int $tenantId): ?Product
    {
        $eloquentProduct = EloquentProduct::where('product_code', $productCode)->first();

        if ($eloquentProduct === null)
        {
            return $eloquentProduct;
        }

        $stock = EloquentStockMutation::where("product_id", $eloquentProduct->id)
                                                        ->get()
                                                        ->map(function (EloquentStockMutation $eloquentStockMutation) {
                                                            return $eloquentStockMutation->mutation;
                                                        })
                                                        ->sum();

        return Product::factory()->make([
            'product_code' => $productCode,
            'stock' => $stock,
            'tenant_id' => $tenantId
        ]);
    }

    public function save(Product $product): void
    {
        $eloquentProduct = new EloquentProduct([
            'product_code' => $product->productCode(),
            'tenant_id' => $product->tenantId()
        ]);

        $eloquentProduct->save();

        $eloquentStockMutation = new EloquentStockMutation([
            'mutation' => $product->stock(),
            'product_id' => $eloquentProduct->id,
            'tenant_id' => $product->tenantId()
        ]);

        $eloquentStockMutation->save();
    }

    public function updateStock(string $productCode, int $amount, int $tenantId): Product
    {
        $stock = $this->getStock($productCode, $tenantId);

        if ($amount > $stock)
        {
            $increaseAmount = $amount - $stock;
            $this->increaseStock($productCode, $increaseAmount, $tenantId);
        } else if ($amount < $stock)
        {
            $decreaseAmount = $stock - $amount;
            $this->decreaseStock($productCode, $decreaseAmount, $tenantId);
        }

        return $this->findByProductCodeAndTenantId($productCode, $tenantId);
    }

    public function saveMultiple(Collection $products): void
    {
        $products->each(function (Product $product) {
            $this->save($product);
        });
    }

    public function findAllByTenantId(int $tenantId): Collection
    {
        $eloquentProducts = EloquentProduct::where([
            'tenant_id' => $tenantId
        ])->get();

        return $eloquentProducts->map(function (EloquentProduct $eloquentProduct) use ($tenantId) {
                $stock = EloquentStockMutation::where([
                    'product_id' => $eloquentProduct->id,
                    'tenant_id' => $tenantId
                ])
                ->get()
                ->map(function (EloquentStockMutation $eloquentStockMutation) {
                    return $eloquentStockMutation->mutation;
                })
                ->sum();

                $productCode = $eloquentProduct->product_code;

                return Product::factory()->make([
                    'product_code' => $productCode,
                    'stock' => $stock,
                    'tenant_id' => $tenantId
                ]);
        });
    }
}
