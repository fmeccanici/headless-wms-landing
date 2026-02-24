<?php


namespace App\Inventory\Application\GetProductStock;


interface GetProductStockInterface
{
    /**
     * @param GetProductStockInput $input
     * @return GetProductStockResult
     */
    public function execute(GetProductStockInput $input): GetProductStockResult;
}
