<?php


namespace App\Warehouse\Application\ProcessOrder;


interface ProcessOrderInterface
{
    /**
     * @param ProcessOrderInput $input
     * @return ProcessOrderResult
     */
    public function execute(ProcessOrderInput $input): ProcessOrderResult;
}
