<?php

namespace App\Warehouse\Domain\Picklists;

use App\Warehouse\Domain\Orders\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class PicklistFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding class
     *
     * @var string
     */
    protected $model = Picklist::class;

    /**
     * Define the default state
     *
     * @return array
     */
    public function definition()
    {
        $order = Order::factory()->make();

        return [
            'reference' => uniqid(),
            'order_reference' => $order->reference(),
            'order_lines' => $order->orderLines(),
            'tenant_id' => $order->tenantId()
        ];
    }
}
