<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DtoCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_dto_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:dto', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Infrastructure');
        self::assertFileExists($this->tmpFolder . '/Foo/Infrastructure/Foo.php');
    }

    /** @test */
    public function it_fails_when_the_module_does_not_exists(): void
    {
        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:dto', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));
    }

    /** @test */
    public function it_creates_multiple_dtos_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:dto', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertFileExists($this->tmpFolder . '/Foo/Infrastructure/Foo.php');

        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:dto', [
            'module' => 'Foo',
            'name' => 'Bar',
        ]));

        self::assertFileExists($this->tmpFolder . '/Foo/Infrastructure/Bar.php');
    }
}
