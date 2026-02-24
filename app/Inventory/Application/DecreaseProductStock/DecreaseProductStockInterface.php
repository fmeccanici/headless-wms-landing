<?php


namespace App\Inventory\Application\DecreaseProductStock;


interface DecreaseProductStockInterface
{
    /**
     * @param DecreaseProductStockInput $input
     * @return DecreaseProductStockResult
     */
    public function execute(DecreaseProductStockInput $input): DecreaseProductStockResult;
}
