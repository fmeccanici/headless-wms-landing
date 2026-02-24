<?php


namespace App\Inventory\Application\GetProductStock;

use App\Inventory\Domain\Exceptions\ProductNotFoundException;
use App\Inventory\Domain\Repositories\ProductRepositoryInterface;

class GetProductStock implements GetProductStockInterface
{
    private ProductRepositoryInterface $productRepository;

    /**
     * GetProductStock constructor.
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     * @throws ProductNotFoundException
     */
    public function execute(GetProductStockInput $input): GetProductStockResult
    {
        $productCode = $input->productCode();
        $product = $this->productRepository->findByProductCodeAndTenantId($productCode, $input->tenantId());

        if ($product === null)
        {
            throw new ProductNotFoundException('Product with product code ' . $productCode . ' not found');
        }

        $stock = $product->stock();

        return new GetProductStockResult($stock);
    }
}
