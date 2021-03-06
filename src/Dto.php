<?php

abstract class Dto
{
    private $properties;

    private function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public static function createFromArray($properties)
    {
        return new static($properties);
    }

    public function set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }

    public function get($propertyName)
    {
        return $this->properties[$propertyName] ?? null;
    }

    public static function getPropertyNames()
    {
        $properties = (new ReflectionClass(new static([])))
            ->getProperties(ReflectionProperty::IS_PUBLIC);

        return array_map(function ($item) {
            return $item->getName();
        }, $properties);
    }

    public function asArray()
    {
        $properties = [];

        foreach (static::getPropertyNames() as $itemValue) {
            $properties[$itemValue] = $this->get($itemValue);
        }

        return $properties;
    }

    public function __sleep()
    {
        foreach (self::getPropertyNames() as $propertyName) {
            $this->set(
                $propertyName,
                $this->get($propertyName)
            );
        }

        return self::getPropertyNames();
    }

    public function __wakeup()
    {
        foreach (self::getPropertyNames() as $propertyName) {
            $this->properties[$propertyName] = $this->$propertyName;
            $this->$propertyName = null;
        }

        return self::getPropertyNames();
    }
}
