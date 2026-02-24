<?php


namespace App\Inventory\Application\IncreaseProductStock;


interface IncreaseProductStockInterface
{
    /**
     * @param IncreaseProductStockInput $input
     * @return IncreaseProductStockResult
     */
    public function execute(IncreaseProductStockInput $input): IncreaseProductStockResult;
}
