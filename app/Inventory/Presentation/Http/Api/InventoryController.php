<?php


namespace App\Inventory\Presentation\Http\Api;


use App\Inventory\Application\CreateProduct\CreateProduct;
use App\Inventory\Application\CreateProduct\CreateProductInput;
use App\Inventory\Application\DecreaseProductStock\DecreaseProductStock;
use App\Inventory\Application\DecreaseProductStock\DecreaseProductStockInput;
use App\Inventory\Application\GetProductStock\GetProductStock;
use App\Inventory\Application\GetProductStock\GetProductStockInput;
use App\Inventory\Application\IncreaseProductStock\IncreaseProductStock;
use App\Inventory\Application\IncreaseProductStock\IncreaseProductStockInput;
use App\Inventory\Application\UpdateProductStock\UpdateProductStock;
use App\Inventory\Application\UpdateProductStock\UpdateProductStockInput;
use App\Inventory\Domain\Exceptions\InvalidUserException;
use App\Inventory\Domain\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class InventoryController
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct()
    {
        $this->productRepository = App::make(ProductRepositoryInterface::class);
    }

    public function getProductStock(string $productCode)
    {
        try {

            $user = Auth::user();
            $tenant = $user->tenant;
            $tenantId = $tenant->id;

            $productRepository = App::make(ProductRepositoryInterface::class);
            $getProductStock = new GetProductStock($productRepository);
            $getProductStockInput = new GetProductStockInput([
                "product_code" => $productCode,
                'tenant_id' => $tenantId
            ]);

            $getProductStockResult = $getProductStock->execute($getProductStockInput);

            return [
                "data" => [
                    "product" => [
                        "product_code" => $productCode,
                        "stock" => $getProductStockResult->stock()
                    ]
                ]
            ];
        } catch (\Exception $e)
        {
            return [
                "error" => [
                    "code" => 500,
                    "message" => $e->getMessage()
                ]
            ];
        }
    }

    public function changeProductStock(string $productCode)
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $tenantId = $tenant->id;

        $adjustBy = request("adjust_by");
        $updateWith = request("update_with");

        if ($adjustBy !== null && $updateWith !== null)
        {
            return [
                "error" => [
                    "code" => "500",
                    "message" => "Specify either adjust_by or update_with, not both"
                ]
            ];
        }

        if ($adjustBy === null && $updateWith === null)
        {
            return [
                "error" => [
                    "code" => "500",
                    "message" => "You should either specify adjust_by or update_with"
                ]
            ];
        }

        $productRepository = App::make(ProductRepositoryInterface::class);

        if ($adjustBy !== null)
        {
            if ($adjustBy > 0)
            {
                $increaseStock = new IncreaseProductStock($productRepository);
                $increaseStockInput = new IncreaseProductStockInput([
                    "product_code" => $productCode,
                    "quantity" => $adjustBy,
                    'tenant_id' => $tenantId
                ]);

                $increaseStockResult = $increaseStock->execute($increaseStockInput);
                $product = $increaseStockResult->product();
            } else {
                $decreaseQuantity = - $adjustBy;
                $decreaseStock = new DecreaseProductStock($productRepository);
                $decreaseStockInput = new DecreaseProductStockInput([
                    "product_code" => $productCode,
                    "quantity" => $decreaseQuantity,
                    'tenant_id' => $tenantId
                ]);

                $decreaseStockResult = $decreaseStock->execute($decreaseStockInput);

                $product = $decreaseStockResult->product();
            }
        } else {
            $updateStock = new UpdateProductStock($productRepository);
            $updateStockInput = new UpdateProductStockInput([
                "product_code" => $productCode,
                "quantity" => $updateWith,
                'tenant_id' => $tenantId
            ]);

            $updateStockResult = $updateStock->execute($updateStockInput);
            $product = $updateStockResult->product();
        }

        return [
            "data" => $product->toArray()
        ];
    }

    public function createProduct()
    {
        try {
            $user = Auth::user();
            $tenant = $user->tenant;
            $tenantId = $tenant->id;

            $product = request('product');
            $productCode = $product["product_code"];
            $stock = $product["stock"];

            $productRepository = App::make(ProductRepositoryInterface::class);

            $createProduct = new CreateProduct($productRepository);
            $createProductInput = new CreateProductInput([
                'product_code' => $productCode,
                'stock' => $stock,
                'tenant_id' => $tenantId
            ]);

            $createProductResult = $createProduct->execute($createProductInput);
            $response["data"] = null;

            return $response;

        } catch (\Exception $e)
        {
            $response["data"] = null;
            $response["error"]['message'] = $e->getMessage();
            $response['error']['code'] = $e->getCode();

            return $response;
        }

    }

    /**
     * @throws InvalidUserException
     */
    public function getAllProducts(Request $request)
    {
        try {
            $user = Auth::user();

            $tenant = $user->tenant;
            $tenantId = $tenant->id;

            $products = $this->productRepository->findAllByTenantId($tenantId);

            $response['data']['products'] = $products->toArray();
        } catch (\Exception | \Error $e)
        {
            $response['error']['code'] = 5;
            $response['error']['message'] = $e->getMessage();
        }

        return $response;

    }
}
