<?php


namespace App\Inventory\Application\UpdateProductStock;


use App\Inventory\Domain\Products\Product;

final class UpdateProductStockResult
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
