<?php

namespace App\Warehouse\Infrastructure\Services;

use App\Inventory\Application\GetProductStock\GetProductStock;
use App\Inventory\Application\GetProductStock\GetProductStockInput;
use App\Inventory\Application\UpdateProductStock\UpdateProductStock;
use App\Inventory\Application\UpdateProductStock\UpdateProductStockInput;
use App\Inventory\Domain\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\App;

class InventoryService implements \App\Warehouse\Domain\Services\InventoryServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct()
    {
        $this->productRepository = App::make(ProductRepositoryInterface::class);
    }

    public function getStock(string $productCode, int $tenantId): int
    {
        $getStock = new GetProductStock($this->productRepository);
        $getStockInput = new GetProductStockInput([
            'product_code' => $productCode,
            'tenant_id' => $tenantId
        ]);

        $getStockResult = $getStock->execute($getStockInput);

        return $getStockResult->stock();
    }

    public function adjustStock(string $productCode, int $quantity, int $tenantId): int
    {
        $currentStock = $this->productRepository->getStock($productCode, $tenantId);
        $updatedStock = $currentStock + $quantity;

        $updateStock = new UpdateProductStock($this->productRepository);
        $updateStockInput = new UpdateProductStockInput([
            'product_code' => $productCode,
            'quantity' => $updatedStock,
            'tenant_id' => $tenantId
        ]);

        $result = $updateStock->execute($updateStockInput);

        return $result->product()->stock();
    }
}
