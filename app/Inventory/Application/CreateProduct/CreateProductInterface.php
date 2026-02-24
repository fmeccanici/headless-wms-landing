<?php


namespace App\Inventory\Application\CreateProduct;


interface CreateProductInterface
{
    /**
     * @param CreateProductInput $input
     * @return CreateProductResult
     */
    public function execute(CreateProductInput $input): CreateProductResult;
}
