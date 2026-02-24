<?php

namespace HomeDesignShops\LaravelDdd\Support;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class ListResult
{
    /**
     * Items per page
     */
    protected int $perPage = 50;

    /**
     * Current page
     */
    protected int $currentPage = 1;

    /**
     * @var Paginator
     */
    public Paginator $data;

    /**
     * @param array|Collection $data
     */
    public function __construct(mixed $data = [])
    {
        if($data instanceof LengthAwarePaginator) {
            $this->data = $data;
        } else {
            $this->data = new LengthAwarePaginator($data, count($data), $this->perPage, $this->currentPage);
        }
    }
}