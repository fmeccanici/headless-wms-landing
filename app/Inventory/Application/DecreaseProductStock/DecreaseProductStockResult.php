<?php


namespace App\Inventory\Application\DecreaseProductStock;


use App\Inventory\Domain\Products\Product;

final class DecreaseProductStockResult
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
