<?php


namespace App\Inventory\Application\CreateProduct;

use App\Inventory\Domain\Exceptions\CreateProductOperationException;
use App\Inventory\Domain\Products\Product;
use App\Inventory\Domain\Repositories\ProductRepositoryInterface;

class CreateProduct implements CreateProductInterface
{
    private ProductRepositoryInterface $productRepository;

    /**
     * CreateProduct constructor.
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     * @throws CreateProductOperationException
     */
    public function execute(CreateProductInput $input): CreateProductResult
    {
        $alreadyPresentProduct = $this->productRepository->findByProductCodeAndTenantId($input->productCode(), $input->tenantId());

        if ($alreadyPresentProduct !== null)
        {
            throw new CreateProductOperationException("Product with product code " . $input->productCode() . " already exists");
        }

        $product = Product::factory()->make([
            'product_code' => $input->productCode(),
            'stock' => $input->stock(),
            'tenant_id' => $input->tenantId()
        ]);
        $this->productRepository->save($product);

        return new CreateProductResult($product);
    }
}
