<?php

namespace HomeDesignShops\LaravelDdd\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ConsoleCommandTest extends TestCase
{
    /** @test */
    public function it_create_a_console_command_for_an_existing_module(): void
    {
        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:new', [
            'name' => 'Foo',
        ]));

        self::assertIsInt(Command::SUCCESS, Artisan::call('ddd:command', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));

        self::assertDirectoryExists($this->tmpFolder . '/Foo/Presentation/Console/Commands');
        self::assertFileExists($this->tmpFolder . '/Foo/Presentation/Console/Commands/FooCommand.php');
    }

    /** @test */
    public function it_fails_when_the_module_does_not_exists(): void
    {
        self::assertIsInt(Command::FAILURE, Artisan::call('ddd:command', [
            'module' => 'Foo',
            'name' => 'Foo',
        ]));
    }
}
