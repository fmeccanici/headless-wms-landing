<?php


namespace App\Inventory\Application\GetProductStock;


final class GetProductStockResult
{
    private int $stock;

    public function __construct(int $stock)
    {
        $this->stock = $stock;
    }

    public function stock(): int
    {
        return $this->stock;
    }
}
