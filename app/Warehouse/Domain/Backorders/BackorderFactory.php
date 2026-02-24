<?php

namespace App\Warehouse\Domain\Backorders;

use App\Warehouse\Domain\Orders\Order;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;


class BackorderFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding class
     *
     * @var string
     */
    protected $model = Backorder::class;

    /**
     * Define the default state
     *
     * @return array
     */
    public function definition()
    {
        $order = Order::factory()->make();

        return [
            "reference" => uniqid(),
            "order_lines" => $order->orderLines(),
            "order_reference" => $order->reference(),
            "tenant_id" => $order->tenantId(),
            'inventory_service' => App::make(InventoryServiceInterface::class)
        ];
    }
}
