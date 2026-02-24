<?php

namespace HomeDesignShops\LaravelDdd\Tests\Support;

use HomeDesignShops\LaravelDdd\Tests\TestCase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListResultTest extends TestCase
{

    /** @test */
    public function it_should_support_array_data()
    {
        // Given
        $data = $this->dummyData();

        // When
        $result = new TestListResult($data, $perPage = 50, $currentPage = 1);

        // Then
        $this->assertCount(2, $result->data);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result->data);
        $this->assertEquals($data, $result->data->items());
        $this->assertEquals($perPage, $result->data->perPage());
        $this->assertEquals($currentPage, $result->data->currentPage());
    }

    /** @test */
    public function it_should_support_a_collection()
    {
        // Given
        $data = collect($this->dummyData());

        // When
        $result = new TestListResult($data, $perPage = 50, $currentPage = 1);

        // Then
        $this->assertCount(2, $result->data);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result->data);
        $this->assertEquals($data->toArray(), $result->data->items());
        $this->assertEquals($perPage, $result->data->perPage());
        $this->assertEquals($currentPage, $result->data->currentPage());
    }

    /** @test */
    public function it_should_set_a_paginator()
    {
        // Given
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 50);

        // When
        $result = new TestListResult($paginator);

        // Then
        $this->assertInstanceOf(LengthAwarePaginator::class, $result->data);
        $this->assertEquals([], $result->data->items());
    }

    /**
     * @return string[][]
     */
    protected function dummyData(): array
    {
        return [
            [
                'name' => 'Kevin Koenen',
                'email' => 'kevin@homedesignshops.nl'
            ],
            [
                'name' => 'Floris Meccanici',
                'email' => 'floris@homedesignshops.nl'
            ]
        ];
    }

}