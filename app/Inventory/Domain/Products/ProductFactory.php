<?php

namespace App\Inventory\Domain\Products;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class ProductFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding class
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the default state
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {

        return [
            "product_code" => uniqid(),
            "stock" => random_int(1, 10000),
            "tenant_id" => random_int(1, 10),
        ];
    }
}
