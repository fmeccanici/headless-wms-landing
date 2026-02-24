<?php

namespace HomeDesignShops\LaravelDdd\Tests\Support;

use HomeDesignShops\LaravelDdd\Support\ListResult;

class TestListResult extends ListResult
{
    public function __construct(mixed $data, int $perPage = 50, int $currentPage = 1)
    {
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;

        parent::__construct($data);
    }
}