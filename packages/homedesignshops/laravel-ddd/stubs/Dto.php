<?php


namespace App\Module\Infrastructure;

use HomeDesignShops\LaravelDdd\Support\ValueObject;

class Dto extends ValueObject
{
    protected string $id;

    public function __construct(string $id)
    {
        $params = [
            'id' => $id,
        ];

        parent::__construct($params);
    }
}