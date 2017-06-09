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

    public function get($propertyName)
    {
        return isset($this->properties[$propertyName])
            ? $this->properties[$propertyName]
            : null;
    }

    public static function getPropertyNames()
    {
        $reflected = new ReflectionClass(new static(array()));
        $properties = $reflected->getProperties(ReflectionProperty::IS_PRIVATE);

        return array_map(function ($item) {
            return $item->getName();
        }, $properties);
    }

    public function asArray()
    {
        $properties = array();

        foreach (static::getPropertyNames() as $itemValue) {
            $properties[$itemValue] = $this->get($itemValue);
        }

        return $properties;
    }
}
