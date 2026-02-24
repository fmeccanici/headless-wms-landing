<?php


namespace App\Warehouse\Application\GetAllOrders;


use Illuminate\Support\Collection;

final class GetAllOrdersResult
{
    private Collection $orders;

    /**
     * @param Collection $orders
     */
    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function orders(): Collection
    {
        return $this->orders;
    }
}
