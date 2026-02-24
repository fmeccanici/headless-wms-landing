<?php


namespace HomeDesignShops\LaravelDdd\Support;


use DeepCopy\Exception\PropertyException;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class ValueObject
 * @package App
 */
abstract class ValueObject
{
    /**
     * Here you may specify which filter we use to filter down the properties of a class.
     *
     * @var int
     */
    protected static $propertyFilter = ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED;

    /**
     * Array of properties and values of the class.
     *
     * @var array
     */
    protected $properties;

    /**
     * ValueObject constructor.
     *
     * @param iterable|array $params
     */
    public function __construct(iterable $params)
    {
        // Filter down the params we can set.
        $this->properties = array_filter($params, function($key) {
            return in_array($key, $this->getClassProperties(), true);
        }, ARRAY_FILTER_USE_KEY);

        // Set the property
        foreach ($this->properties as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * Throws an exception if some one tries to set the property.
     * You are only allowed to set properties passed in the constructor.
     *
     * @param $name
     * @param $value
     * @throws PropertyException
     */
    public function __set($name, $value)
    {
        throw new PropertyException(sprintf('Not allowed to set property %s on %s', $name, class_basename($this)));
    }

    /**
     * Returns true if the name of the property was set.
     * Otherwise false.
     *
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return array_key_exists($name, $this->properties);
    }

    /**
     * Get the properties of this class.
     *
     * @return array|string[]
     */
    private function getClassProperties(): array
    {
        $reflectionProperties = (new ReflectionClass($this))->getProperties(self::$propertyFilter);

        return array_map(static function (ReflectionProperty $property) {
            return $property->getName();
        }, $reflectionProperties);
    }
}
