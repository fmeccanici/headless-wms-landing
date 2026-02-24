<?php


namespace App\Warehouse\Presentation\Http\Api;


use App\SharedKernel\DDD\Exceptions\NotFoundException;
use App\Warehouse\Application\CreateOrder\CreateOrder;
use App\Warehouse\Application\CreateOrder\CreateOrderInput;
use App\Warehouse\Application\GetAllOrders\GetAllOrders;
use App\Warehouse\Application\GetAllOrders\GetAllOrdersInput;
use App\Warehouse\Application\ProcessOrder\ProcessOrder;
use App\Warehouse\Application\ProcessOrder\ProcessOrderInput;
use App\Warehouse\Domain\Orders\Order;
use App\Warehouse\Domain\Repositories\OrderRepositoryInterface;
use App\Warehouse\Domain\Services\InventoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class WarehouseController
{
    protected OrderRepositoryInterface $orderRepository;
    protected ?\Illuminate\Contracts\Auth\Authenticatable $user;
    protected InventoryServiceInterface $inventoryService;

    public function __construct()
    {
        $this->orderRepository = App::make(OrderRepositoryInterface::class);
        $this->inventoryService = App::make(InventoryServiceInterface::class);
    }

    public function processOrder(string $orderReference)
    {
        try {
            $orderRepository = App::make(OrderRepositoryInterface::class);

            $processOrder = new ProcessOrder($orderRepository,
                $this->inventoryService);

            $user = Auth::user();
            $tenant = $user->tenant;
            $tenantId = $tenant->id;

            $processOrderInput = new ProcessOrderInput([
                "order_reference" => $orderReference,
                "tenant_id" => $tenantId
            ]);

            $processOrderResult = $processOrder->execute($processOrderInput);
            $response['data'] = null;
            return $response;
        } catch (NotFoundException $notFoundException)
        {
            $response['error']['code'] = 1;
            $response['error']['message'] = $notFoundException->getMessage();
        }

        return $response;
    }

    public function processBackorders()
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $orders = $this->orderRepository->findAllByTenantId($tenantId);
        $orders->each(function (Order $order) {
            $order->processBackorders();
        });

        $response['data'] = $orders->toArray();

        return $response;
    }

    public function createOrder()
    {
        try {
            $user = Auth::user();
            $tenant = $user->tenant;

            $order = request()->all();
            $order["tenant_id"] = $tenant->id;

            $orderRepository = App::make(OrderRepositoryInterface::class);
            $createOrder = new CreateOrder($orderRepository);

            $createOrderInput = new CreateOrderInput([
                "order" => $order
            ]);

            $createOrderResult = $createOrder->execute($createOrderInput);

            $response["data"] = null;

            return $response;

        } catch (\Exception $e)
        {
            $response["data"] = null;
            $response["error"] = $e->getMessage();

            return $response;
        }

    }

    public function getAllOrders()
    {
        $user = Auth::user();
        $tenant = $user->tenant;

        $orderRepository = App::make(OrderRepositoryInterface::class);
        $getAllOrders = new GetAllOrders($orderRepository);

        $getAllOrdersInput = new GetAllOrdersInput([
            "tenant_id" => $tenant->id
        ]);

        $getAllOrdersResult = $getAllOrders->execute($getAllOrdersInput);

        $response["data"] = $getAllOrdersResult->orders()->toArray();
        return $response;
    }

    public function getAllBackorders()
    {
        $user = Auth::user();
        $tenant = $user->tenant;

        $orders = $this->orderRepository->findAllByTenantId($tenant->id);

        $backorders = $orders->map(function (Order $order) {
            return $order->backorders();
        })->collapse();

        $response["data"] = $backorders->toArray();

        return $response;
    }

    public function getAllPicklists()
    {
        $user = Auth::user();
        $tenant = $user->tenant;

        $orders = $this->orderRepository->findAllByTenantId($tenant->id);
        $picklists = $orders->map(function (Order $order) {
            return $order->picklists();
        })->collapse();

        $response["data"] = $picklists->toArray();
        return $response;
    }

    public function getOrderByReference(Request $request, string $orderReference)
    {
        $user = Auth::user();
        $tenant = $user->tenant;

        $order = $this->orderRepository->findOneByReferenceAndTenantId($orderReference, $tenant->id);

        if ($order)
        {
            $response['data'] = $order->toArray();
            return $response;
        }

        $response['error']['code'] = 1;
        $response['error']['message'] = 'Order with reference ' . $orderReference . ' not found';

        return response($response, 404);
    }

    public function getPicklistsForOrder(Request $request, string $orderReference)
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $order = $this->orderRepository->findOneByReferenceAndTenantId($orderReference, $tenantId);

        if ($order === null)
        {
            $response['error']['code'] = 2;
            $response['error']['message'] = 'Order with reference ' . $orderReference . ' not found';

            return response($response, 404);
        }

        $response['data'] = $order->picklists()->toArray();
        return $response;
    }

    public function getBackordersForOrder(Request $request, string $orderReference)
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $order = $this->orderRepository->findOneByReferenceAndTenantId($orderReference, $tenantId);

        if ($order === null)
        {
            $response['error']['code'] = 2;
            $response['error']['message'] = 'Order with reference ' . $orderReference . ' not found';

            return response($response, 404);
        }


        $response['data'] = $order->backorders()->toArray();
        return $response;
    }

    public function pickAllProductFromPicklist(Request $request, int|string $picklistId)
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $orders = $this->orderRepository->findAllByTenantId($tenantId);

        $orderWithPicklist = $orders->filter(function (Order $order) use ($picklistId) {
            return $order->picklist($picklistId) !== null;
        })->first();

        if ($orderWithPicklist === null)
        {
            $response['error']['message'] = "Picklist with id or reference {$picklistId} not found";
            $response['error']['code'] = 1;

            return response($response, 404);
        }

        $orderWithPicklist->fullyPickPicklist($picklistId);

        $this->orderRepository->saveMultiple($orders);

        $response['data'] = $orderWithPicklist->picklist($picklistId)->toArray();
        return $response;
    }

    public function cancelPicklist(Request $request, string $picklistId)
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $orders = $this->orderRepository->findAllByTenantId($tenantId);

        $orderWithPicklist = $orders->filter(function (Order $order) use ($picklistId) {
            return $order->picklist($picklistId) !== null;
        })->first();

        if ($orderWithPicklist === null)
        {
            $response['error']['message'] = "Picklist with id or reference {$picklistId} not found";
            $response['error']['code'] = 1;

            return response($response, 404);
        }

        $orderWithPicklist->cancelPicklist($picklistId);

        $this->orderRepository->save($orderWithPicklist);
        $response['data'] = $orderWithPicklist->toArray();

        return $response;
    }
}
