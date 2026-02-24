<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UseCaseCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_use_case_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Application/Foo');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/Foo.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooInput.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooInterface.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/Foo/FooResult.php');

        $commandResult = Artisan::call('ddd:use-case', [
            'module' => 'Foo',
            'name' => 'CreateFoo',
        ]);

        self::assertIsInt(Command::SUCCESS, $commandResult);

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Application/CreateFoo');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateFoo/CreateFoo.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateFoo/CreateFooInput.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateFoo/CreateFooInterface.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateFoo/CreateFooResult.php');
    }

    /** @test */
    public function it_create_a_list_use_case_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        $commandResult = Artisan::call('ddd:use-case', [
            'module' => 'Foo',
            'name' => 'ListFoo',
            '--list' => true
        ]);

        self::assertIsInt(Command::SUCCESS, $commandResult);

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Application/ListFoo');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/ListFoo/ListFoo.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/ListFoo/ListFooInput.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/ListFoo/ListFooInterface.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/ListFoo/ListFooResult.php');
    }

    /** @test */
    public function it_fails_when_the_module_does_not_exists(): void
    {
        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:use-case', [
            'module' => 'Foo',
            'name' => 'CreateFoo',
        ]));
    }

    /** @test */
    public function it_creates_multiple_use_cases_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:use-case', [
            'module' => 'Foo',
            'name' => 'CreateFoo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:use-case', [
            'module' => 'Foo',
            'name' => 'CreateBar',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Application/CreateBar');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateBar/CreateBar.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateBar/CreateBarInput.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateBar/CreateBarInterface.php');
        self::assertFileExists($this->tmpFolder . '/Foo/Application/CreateBar/CreateBarResult.php');
    }
}
