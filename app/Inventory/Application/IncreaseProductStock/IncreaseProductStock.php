<?php


namespace App\Inventory\Application\IncreaseProductStock;

use App\Inventory\Domain\Repositories\ProductRepositoryInterface;

class IncreaseProductStock implements IncreaseProductStockInterface
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
    public function execute(IncreaseProductStockInput $input): IncreaseProductStockResult
    {
        $product = $this->productRepository->increaseStock($input->productCode(), $input->quantity(), $input->tenantId());
        return new IncreaseProductStockResult($product);
    }
}
