<?php


namespace App\Warehouse\Application\GetAllOrders;


interface GetAllOrdersInterface
{
    /**
     * @param GetAllOrdersInput $input
     * @return GetAllOrdersResult
     */
    public function execute(GetAllOrdersInput $input): GetAllOrdersResult;
}
