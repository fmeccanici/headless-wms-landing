<?php


namespace App\Inventory\Application\IncreaseProductStock;


use App\Inventory\Domain\Products\Product;

final class IncreaseProductStockResult
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
