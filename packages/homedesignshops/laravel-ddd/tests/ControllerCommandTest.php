<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ControllerCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_controller_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:controller', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Presentation/Http');
        self::assertFileExists($this->tmpFolder . '/Foo/Presentation/Http/FooController.php');
    }

    /** @test */
    public function it_create_a_api_controller_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:controller', [
            'module' => 'Foo',
            'name' => 'Foo',
            '--api' => true,
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Presentation/Http/Api');
        self::assertFileExists($this->tmpFolder . '/Foo/Presentation/Http/Api/FooController.php');
    }

    /** @test */
    public function it_fails_when_the_module_does_not_exists(): void
    {
        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:controller', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));
    }
}
