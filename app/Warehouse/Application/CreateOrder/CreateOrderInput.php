<?php


namespace App\Warehouse\Application\CreateOrder;

use PASVL\Validation\ValidatorBuilder;

final class CreateOrderInput
{
    private array $order;

    private function validate($input)
    {
        $pattern = [
            "order" => [
                "reference" => ":string",
                "customer_number" => ":string",
                "is_guest_order" => ":bool",
                "tenant_id" => ":number :int",
                "order_lines" => [
                    "*" => [
                        "product_code" => ":string",
                        "quantity" => ":number :int"
                    ]
                ]
            ]
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($input);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->order = $input["order"];
    }

    public function order(): array
    {
        return $this->order;
    }

}
