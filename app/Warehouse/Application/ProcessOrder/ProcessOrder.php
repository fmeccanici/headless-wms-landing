<?php


namespace App\Warehouse\Application\ProcessOrder;

use App\Warehouse\Domain\Exceptions\OrderNotFoundException;
use App\Warehouse\Domain\Orders\OrderLine;
use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;
use App\Warehouse\Domain\Services\InventoryServiceInterface;

class ProcessOrder implements ProcessOrderInterface
{
    private OrderRepositoryInterface $orderRepository;
    private InventoryServiceInterface $inventoryService;

    /**
     * ProcessOrder constructor.
     */
    public function __construct(OrderRepositoryInterface $orderRepository,
                                InventoryServiceInterface $inventoryService)
    {
        $this->orderRepository = $orderRepository;
        $this->inventoryService = $inventoryService;
    }

    /**
     * @inheritDoc
     * @throws OrderNotFoundException
     */
    public function execute(ProcessOrderInput $input): ProcessOrderResult
    {
        $order = $this->orderRepository->findOneByReferenceAndTenantId($input->orderReference(), $input->tenantId());

        if ($order === null)
        {
            throw new OrderNotFoundException('Order with reference ' . $input->orderReference() . ' not found');
        }

        $onStockOrderLines = $order->orderLines()->filter(function (OrderLine $orderLine) use ($order) {
            return $this->inventoryService->getStock($orderLine->product()->productCode(), $order->tenantId()) > 0;
        });

        $outOfStockOrderLines = $order->orderLines()->filter(function (OrderLine $orderLine) use ($order) {
            return $this->inventoryService->getStock($orderLine->product()->productCode(), $order->tenantId()) <= 0;
        });

        if ($onStockOrderLines->count() > 0)
        {
            $picklists = $order->picklists();

            if ($picklists->isEmpty())
            {
                $order->createPicklist($onStockOrderLines);
                $this->orderRepository->save($order);
            }

            $onStockOrderLines->each(function (OrderLine $orderLine) use ($order) {
                $this->inventoryService->adjustStock($orderLine->product()->productCode(), - $orderLine->quantity(), $order->tenantId());
            });
        }

        if ($outOfStockOrderLines->count() > 0)
        {
            $backorders = $order->backorders();

            if ($backorders->isEmpty())
            {
                $order->createBackorder($outOfStockOrderLines);
                $this->orderRepository->save($order);
            }
        }

        return new ProcessOrderResult();
    }
}
