<?php

namespace App\SharedKernel\Common;

use ReflectionClass;
use ReflectionException;

class ReflectionClassCache
{
    protected static array $cache;

    /**
     * @param string $className
     * @return ReflectionClass
     * @throws ReflectionException
     */
    public static function getReflectionClass(string $className): ReflectionClass
    {
        if (! isset(static::$cache[$className])) {
            static::$cache[$className] = new ReflectionClass($className);
        }

        return static::$cache[$className];
    }

}
