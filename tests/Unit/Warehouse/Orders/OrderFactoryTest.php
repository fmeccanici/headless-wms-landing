<?php

namespace Tests\Unit\Warehouse\Orders;

use App\Warehouse\Domain\Orders\Order;
use Illuminate\Support\Collection;
use Tests\TestCase;

class OrderFactoryTest extends TestCase
{
    /** @test */
    public function it_should_create_an_order()
    {
        // Given

        // When
        $order = Order::factory()->make();

        // Then
        self::assertInstanceOf(Order::class, $order);
    }

    /** @test */
    public function it_should_create_a_collection_of_orders(){

        // Given

        // When
        $orders = Order::factory(10)->make();

        // Then
        self::assertInstanceOf(Collection::class, $orders);
        self::assertEquals(10, $orders->count());
    }

    /** @test */
    public function it_should_create_an_order_with_specified_customer_number()
    {
        // Given
        $customerNumber = uniqid();

        // When
        $order = Order::factory()->make([
            "customer_number" => $customerNumber
        ]);

        // Then
        self::assertEquals($customerNumber, $order->customerNumber());
    }

    /** @test */
    public function it_should_create_an_order_with_specified_is_guest_order()
    {
        // Given
        $isGuestOrder = false;

        // When
        $order = Order::factory()->make([
            "is_guest_order" => $isGuestOrder
        ]);

        // Then
        self::assertEquals($isGuestOrder, $order->isGuestOrder());
    }
}
