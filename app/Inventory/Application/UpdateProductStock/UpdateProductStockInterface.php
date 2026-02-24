<?php


namespace App\Inventory\Application\UpdateProductStock;


interface UpdateProductStockInterface
{
    /**
     * @param UpdateProductStockInput $input
     * @return UpdateProductStockResult
     */
    public function execute(UpdateProductStockInput $input): UpdateProductStockResult;
}
