<?php


namespace App\Warehouse\Application\GetAllOrders;

use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;

class GetAllOrders implements GetAllOrdersInterface
{
    private OrderRepositoryInterface $orderRepository;

    /**
     * GetAllOrders constructor.
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(GetAllOrdersInput $input): GetAllOrdersResult
    {
        $orders = $this->orderRepository->findAllByTenantId($input->tenantId());
        return new GetAllOrdersResult($orders);
    }
}
