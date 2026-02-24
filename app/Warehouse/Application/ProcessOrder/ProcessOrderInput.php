<?php


namespace App\Warehouse\Application\ProcessOrder;

use PASVL\Validation\ValidatorBuilder;

final class ProcessOrderInput
{
    private string $orderReference;
    private int $tenantId;

    private function validate($input)
    {
        $pattern = [
            "order_reference" => ":string",
            "tenant_id" => ":number :int"
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->orderReference = $input["order_reference"];
        $this->tenantId = $input["tenant_id"];
    }

    public function orderReference(): string
    {
        return $this->orderReference;
    }

    public function tenantId(): int
    {
        return $this->tenantId;
    }
}
