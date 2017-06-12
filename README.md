# Dto

Given a Dto like this:

```
class Person extends Dto
{
    public $name;
    public $surname;
}
```

## available property names

    Person::getPropertyNames(); // [ 'name', 'surname', ];

## properties accessibility

    $dto = Person::createFromArray([ 'name' => 'Simone', ]);

    $dto->get('name'); // 'Simone'

## properties as array

    $dto = Person::createFromArray([
          'name' => 'Simone',
          'surname' => 'Gentili',
    ]);

    $dto->asArray(); // [ 'name' => 'Simone', 'surname' => 'Gentili', ];
