<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RepositoryCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_repository_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:repository', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Infrastructure/Repositories');
        self::assertFileExists($this->tmpFolder . '/Foo/Infrastructure/Repositories/FooRepository.php');
    }

    /** @test */
    public function it_create_a_repository_interface_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:repository', [
            'module' => 'Foo',
            'name' => 'Foo',
            '--interface' => true,
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Domain/Repositories');
        self::assertFileExists($this->tmpFolder . '/Foo/Domain/Repositories/FooRepositoryInterface.php');
    }

    /** @test */
    public function it_fails_when_the_module_does_not_exists(): void
    {
        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:repository', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));
    }

    /** @test */
    public function it_creates_multiple_repositories_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:repository', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:repository', [
            'module' => 'Foo',
            'name' => 'Bar',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Infrastructure/Repositories');
        self::assertFileExists($this->tmpFolder . '/Foo/Infrastructure/Repositories/BarRepository.php');
    }
}
