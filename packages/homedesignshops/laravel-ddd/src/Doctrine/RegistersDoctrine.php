<?php

namespace HomeDesignShops\LaravelDdd\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Persistence\Mapping\Driver\PHPDriver;
use Illuminate\Contracts\Foundation\Application;

trait RegistersDoctrine
{
    protected function registerDoctrineEntityManager()
    {
        $moduleName = str_replace('ServiceProvider', '', class_basename(get_class($this)));

        $this->app->singleton($moduleName.'EntityManager', function(Application $app) use ($moduleName) {
            $mappingPaths = glob(app_path($moduleName.'/Infrastructure/Persistence/Doctrine/') . '*', GLOB_ONLYDIR);

            $dbConfig = config('database.connections.'.strtolower($moduleName));

            $connection = [
                'driver' => $dbConfig['doctrine_driver'] ?? $dbConfig['driver'],
                'host' => $dbConfig['host'],
                'user' => $dbConfig['username'],
                'password' => $dbConfig['password'],
                'dbname' => $dbConfig['database'],
            ];

            $locator = new MappingFileLocator($mappingPaths, 'Mapping.php');
            $driver = new PHPDriver($locator);

            $config = Setup::createConfiguration();
            $config->setMetadataDriverImpl($driver);

            return EntityManager::create($connection, $config);
        });
    }
}