<?php


namespace App\Warehouse\Application\CreateOrder;

use App\Warehouse\Domain\Exceptions\CreateOrderOperationException;
use App\Warehouse\Domain\Orders\Order;
use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;

class CreateOrder implements CreateOrderInterface
{
    private OrderRepositoryInterface $orderRepository;

    /**
     * CreateOrder constructor.
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @inheritDoc
     * @throws CreateOrderOperationException
     */
    public function execute(CreateOrderInput $input): CreateOrderResult
    {
        $order = Order::fromArray($input->order());

        $alreadyPresentOrder = $this->orderRepository->findOneByReferenceAndTenantId($order->reference(), $order->tenantId());

        if ($alreadyPresentOrder !== null)
        {
            throw new CreateOrderOperationException("Order with reference " . $order->reference() . " already exists");
        }

        $this->orderRepository->save($order);

        return new CreateOrderResult();
    }
}
