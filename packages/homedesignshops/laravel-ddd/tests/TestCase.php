<?php


namespace HomeDesignShops\LaravelDdd\Tests;


use HomeDesignShops\LaravelDdd\LaravelDddServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @var string Temp folder
     */
    protected string $tmpFolder;

    /**
     * Environment setup. Here you can change the config files.
     *
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $this->tmpFolder = __DIR__ .'/../tmp';

        $app['config']->set('laravel-ddd.modules_path', $this->tmpFolder);

        $this->cleanTestTempDirectory();
    }

    /**
     * Loads the service providers from the package.
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [LaravelDddServiceProvider::class];
    }

    /**
     * Cleans the test temp directory.
     */
    protected function cleanTestTempDirectory(): void
    {
        (new Filesystem())->deleteDirectory($this->tmpFolder);
    }
}