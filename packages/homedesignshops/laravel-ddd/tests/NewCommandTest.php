<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class NewCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_new_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Application/Foo');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/Foo.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooInput.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooInterface.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooResult.php');
    }

    /** @test */
    public function it_fails_when_the_module_exists(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));
    }

    /** @test */
    public function it_overwrite_if_force_option_was_provided(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
            '--force'
        ]));
    }
}
