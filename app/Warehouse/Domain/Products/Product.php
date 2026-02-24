<?php

namespace App\Warehouse\Domain\Products;

use App\SharedKernel\DDD\Entity;

class Product extends Entity
{
    protected string $productCode;

    /**
     * @param string $productCode
     */
    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function productCode(): string
    {
        return $this->productCode;
    }

    protected function cascadeSetIdentity(int|string $id): void
    {
        // Nothing to do
    }
}
