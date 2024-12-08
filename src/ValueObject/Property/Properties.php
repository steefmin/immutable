<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

/**
 * @implements \IteratorAggregate<Property>
 */
final class Properties implements \IteratorAggregate, \Countable
{
    /** @var Property[] */
    private array $properties;

    /** @param array<string, mixed> $properties */
    public static function create(array $properties): self
    {
        $self = new self();
        foreach ($properties as $propertyName => $value) {
            $self = $self->appendProperty(Property::create($propertyName, $value));
        }

        return $self;
    }

    public function __construct()
    {
        $this->properties = [];
    }

    public function appendProperty(Property $property): self
    {
        $self = clone $this;
        $self->properties[] = $property;
        return $self;
    }

    /** @return \ArrayIterator<int, Property> */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->properties);
    }

    public function count(): int
    {
        return count($this->properties);
    }

    public function assertPropertyExists(PropertyName $propertyName): void
    {
        $propertiesWithEqualNames = array_filter(
            $this->properties,
            fn(Property $prop) => $prop->name()->equals($propertyName),
        );

        assert(
            count($propertiesWithEqualNames) === 1,
            'No property named `' . $propertyName->toString() . '`',
        );
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        $result = [];

        /** @var Property $property */
        foreach ($this->properties as $property) {
            $result[$property->name()->toString()] = $property->value();
        }

        return $result;
    }
}