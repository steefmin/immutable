<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use SteefMin\Immutable\ValueObject\Arrayable;

/**
 * @implements IteratorAggregate<Property>
 * @implements Arrayable<string, mixed>
 */
final class Properties implements IteratorAggregate, Countable, Arrayable
{
    /** @param Property[] $properties */
    public function __construct(
        private readonly array $properties,
    ) {
    }

    /** @param array<string, mixed> $properties */
    public static function create(array $properties): self
    {
        $self = new self([]);
        foreach ($properties as $propertyName => $value) {
            $self = $self->appendProperty(Property::create($propertyName, $value));
        }

        return $self;
    }

    public function appendProperty(Property $property): self
    {
        $properties = $this->properties;
        $properties[] = $property;
        return new self($properties);
    }

    /** @return ArrayIterator<int, Property> */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->properties);
    }

    public function count(): int
    {
        return count($this->properties);
    }

    public function getPropertyByName(PropertyName $propertyName): ?Property
    {
        foreach ($this->properties as $property) {
            if ($property->name()->equals($propertyName)) {
                return $property;
            }
        }

        return null;
    }

    public function toArray(): array
    {
        $result = [];

        foreach ($this->properties as $property) {
            $result[$property->name()->toString()] = $property->value();
        }

        return $result;
    }
}
