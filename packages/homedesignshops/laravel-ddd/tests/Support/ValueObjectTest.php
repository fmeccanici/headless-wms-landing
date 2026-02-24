<?php

namespace HomeDesignShops\LaravelDdd\Tests\Support;

use HomeDesignShops\LaravelDdd\Support\ValueObject;
use HomeDesignShops\LaravelDdd\Tests\TestCase;

class ValueObjectTest extends TestCase
{
    /** @test */
    public function it_should_create_a_value_object(): void
    {
        $object = new TestObject([
            'id' => 1,
            'name' => 'Foo Bar',
            'list' => [
                'foo' => 'bar'
            ]
        ]);

        self::assertObjectHasAttribute('id', $object);
        self::assertObjectHasAttribute('name', $object);
        self::assertObjectHasAttribute('list', $object);
    }

    /** @test */
    public function it_throws_an_exception_on_invalid_type_parameters(): void
    {
        $this->expectException(\TypeError::class);

        new TestObject([
            'id' => ['error']
        ]);
    }

    /** @test */
    public function it_accepts_objects(): void
    {
        $subObject = new TestSubObject([
            'title' => 'Test Sub Object'
        ]);

        $object = new TestObject([
            'subObject' => $subObject
        ]);

        $this->assertObjectHasAttribute('subObject', $object);
        $this->assertObjectHasAttribute('title', $object->subObject);
        $this->assertEquals('Test Sub Object', $object->subObject->title);
    }
}

/**
 * Class TestObject
 *
 * @property-read int $id
 * @property-read string $name
 * @property-read array $list
 *
 * @property-read TestSubObject $subObject
 *
 * @package HomeDesignShops\LaravelDdd\Tests\Support
 */
class TestObject extends ValueObject
{
    protected int $id;
    protected string $name;
    protected array $list;

    protected TestSubObject $subObject;
}

/**
 * Class TestSubObject
 *
 * @property-read string $title
 *
 * @package HomeDesignShops\LaravelDdd\Tests\Support
 */
class TestSubObject extends ValueObject
{
    protected string $title;
}