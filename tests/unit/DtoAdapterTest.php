<?php

use PHPUnit\Framework\TestCase;

class DtoAdapterTest extends TestCase
{
    public function testProvideDtoPropertyNames()
    {
        $propertyNames = Person::getPropertyNames();

        $expectedProperties = array(
            'name',
            'surname',
        );

        $this->assertEquals(
            $expectedProperties,
            $propertyNames
        );
    }

    public function testProvidePropertyViaGeneralGetter()
    {
        $dto = Person::createFromArray(array(
            'name' => 'Simone',
        ));

        $this->assertEquals(
            'Simone',
            $dto->get('name')
        );
    }

    public function testDTOAcceptOnlyItsOwnProperties()
    {
        $dto = Person::createFromArray(array(
            'name' => 'Simone',
            'sfadfsa' => 'Simone',
        ));

        $expectedProperties = array(
            'name' => 'Simone',
            'surname' => null,
        );

        $this->assertEquals(
            $expectedProperties,
            $dto->asArray()
        );
    }
}
