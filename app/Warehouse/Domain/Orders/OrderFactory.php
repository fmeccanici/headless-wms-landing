<?php

namespace App\Warehouse\Domain\Orders;

use App\Warehouse\Domain\Products\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class OrderFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding class
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the default state
     *
     * @return array
     */
    public function definition()
    {
        $nOrderLines = 30;
        $amountOfOrderLines = random_int(1, $nOrderLines);
        $orderLines = collect();

        for ($i = 0; $i < $amountOfOrderLines; $i++)
        {
            $quantity = random_int(1, 20);
            $orderLine = new OrderLine(new Product(uniqid()), $quantity);
            $orderLines->push($orderLine);
        }

        return [
            "reference" => uniqid(),
            "order_lines" => $orderLines,
            "is_guest_order" => false,
            "customer_number" => uniqid(),
            "tenant_id" => random_int(1, 10),
            'picklists' => collect(),
            'backorders' => collect()
        ];
    }
}
