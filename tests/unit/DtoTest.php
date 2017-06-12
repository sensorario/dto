<?php

use PHPUnit\Framework\TestCase;

class DtoTest extends TestCase
{
    public function testProvideDtoPropertyNames()
    {
        $propertyNames = Person::getPropertyNames();

        $expectedProperties = [
            'name',
            'surname',
        ];

        $this->assertEquals(
            $expectedProperties,
            $propertyNames
        );
    }

    public function testProvidePropertyViaGeneralGetter()
    {
        $dto = Person::createFromArray([
            'name' => 'Simone',
        ]);

        $this->assertEquals(
            'Simone',
            $dto->get('name')
        );
    }

    public function testDTOAcceptOnlyItsOwnProperties()
    {
        $dto = Person::createFromArray([
            'name' => 'Simone',
            'sfadfsa' => 'Simone',
        ]);

        $expectedProperties = [
            'name' => 'Simone',
            'surname' => null,
        ];

        $this->assertEquals(
            $expectedProperties,
            $dto->asArray()
        );
    }

    public function testSerializationKeepSameProperties()
    {
        $dto = Person::createFromArray(array(
            'name' => 'Simone',
            'surname' => 'Gentili',
            'sadfasdrname' => 'Gentili',
        ));

        $serialized = serialize($dto);
        $unserialized = unserialize($serialized);

        $this->assertEquals(
            $dto->asArray(),
            $unserialized->asArray()
        );

        $this->assertEquals(
            array(
                'name' => 'Simone',
                'surname' => 'Gentili',
            ),
            $unserialized->asArray()
        );
    }
}
