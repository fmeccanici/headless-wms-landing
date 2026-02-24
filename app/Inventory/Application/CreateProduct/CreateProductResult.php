<?php


namespace App\Inventory\Application\CreateProduct;


use App\Inventory\Domain\Products\Product;

final class CreateProductResult
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function product(): Product
    {
        return $this->product;
    }
}
