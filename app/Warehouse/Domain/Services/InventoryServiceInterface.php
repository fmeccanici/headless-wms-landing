<?php

namespace App\Warehouse\Domain\Services;

interface InventoryServiceInterface
{
    public function getStock(string $productCode, int $tenantId): int;
    public function adjustStock(string $productCode, int $quantity, int $tenantId): int;
}
