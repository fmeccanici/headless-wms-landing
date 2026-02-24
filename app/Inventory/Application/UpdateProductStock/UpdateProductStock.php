<?php


namespace App\Inventory\Application\UpdateProductStock;

use App\Inventory\Domain\Repositories\ProductRepositoryInterface;

class UpdateProductStock implements UpdateProductStockInterface
{
    private ProductRepositoryInterface $productRepository;

    /**
     * UpdateProductStock constructor.
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(UpdateProductStockInput $input): UpdateProductStockResult
    {
        $product = $this->productRepository->updateStock($input->productCode(), $input->quantity(), $input->tenantId());
        return new UpdateProductStockResult($product);
    }
}
