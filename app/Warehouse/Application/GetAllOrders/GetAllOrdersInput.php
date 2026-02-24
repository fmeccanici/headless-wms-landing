<?php


namespace App\Warehouse\Application\GetAllOrders;

use PASVL\Validation\ValidatorBuilder;

final class GetAllOrdersInput
{
    private int $tenantId;

    private function validate($input)
    {
        $pattern = [
            "tenant_id" => ":number :int"
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->tenantId = $input["tenant_id"];
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }
}
