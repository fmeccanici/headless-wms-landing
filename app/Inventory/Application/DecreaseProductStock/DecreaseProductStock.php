<?php


namespace App\Inventory\Application\DecreaseProductStock;

use App\Inventory\Domain\Repositories\ProductRepositoryInterface;

class DecreaseProductStock implements DecreaseProductStockInterface
{
    private ProductRepositoryInterface $productRepository;

    /**
     * DecreaseProductStock constructor.
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(DecreaseProductStockInput $input): DecreaseProductStockResult
    {
        $product = $this->productRepository->decreaseStock($input->productCode(), $input->quantity(), $input->tenantId());
        return new DecreaseProductStockResult($product);
    }
}
