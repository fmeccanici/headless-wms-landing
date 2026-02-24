<?php


namespace App\Inventory\Application\UpdateProductStock;

use PASVL\Validation\ValidatorBuilder;

final class UpdateProductStockInput
{
    protected string $productCode;
    protected int $quantity;
    protected int $tenantId;

    private function validate($input)
    {
        $pattern = [
            "product_code" => ":string",
            "quantity" => ":number :int",
            'tenant_id' => ':number :int'
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->productCode = $input["product_code"];
        $this->quantity = $input["quantity"];
        $this->tenantId = $input['tenant_id'];
    }

    public function productCode(): string
    {
        return $this->productCode;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }

}
