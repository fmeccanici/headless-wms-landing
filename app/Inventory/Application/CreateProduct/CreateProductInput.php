<?php


namespace App\Inventory\Application\CreateProduct;

use HomeDesignShops\LaravelDdd\Support\Input;
use PASVL\Validation\ValidatorBuilder;

final class CreateProductInput extends Input
{
    private string $productCode;
    private int $stock;
    protected int $tenantId;

    protected function validate($input)
    {
        $pattern = [
            "product_code" => ":string",
            "stock" => ":number :int",
            'tenant_id' => ':number :int'
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->productCode = $input["product_code"];
        $this->stock = $input["stock"];
        $this->tenantId = $input['tenant_id'];
    }

    public function productCode(): string
    {
        return $this->productCode;
    }

    public function stock(): int
    {
        return $this->stock;
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }
}
