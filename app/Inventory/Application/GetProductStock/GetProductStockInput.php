<?php


namespace App\Inventory\Application\GetProductStock;

use PASVL\Validation\ValidatorBuilder;

final class GetProductStockInput
{
    private string $productCode;
    protected int $tenantId;

    private function validate($input)
    {
        $pattern = [
            "product_code" => ":string",
            'tenant_id' => ':number :int'
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->productCode = $input["product_code"];
        $this->tenantId = $input['tenant_id'];
    }

    public function productCode(): string
    {
        return $this->productCode;
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }
}
