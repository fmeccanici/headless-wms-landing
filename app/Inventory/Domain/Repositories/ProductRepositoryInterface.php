<?php

namespace App\Inventory\Domain\Repositories;

use App\Inventory\Domain\Products\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function getStock(string $productCode, int $tenantId): int;
    public function increaseStock(string $productCode, int $amount, int $tenantId): Product;
    public function decreaseStock(string $productCode, int $amount, int $tenantId): Product;
    public function findByProductCodeAndTenantId(string $productCode, int $tenantId): ?Product;
    public function save(Product $product): void;
    public function saveMultiple(Collection $products): void;
    public function updateStock(string $productCode, int $amount, int $tenantId): Product;
    public function findAllByTenantId(int $tenantId): Collection;
}
