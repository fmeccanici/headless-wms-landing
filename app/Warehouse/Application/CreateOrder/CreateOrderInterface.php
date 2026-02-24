<?php


namespace App\Warehouse\Application\CreateOrder;


interface CreateOrderInterface
{
    /**
     * @param CreateOrderInput $input
     * @return CreateOrderResult
     */
    public function execute(CreateOrderInput $input): CreateOrderResult;
}
