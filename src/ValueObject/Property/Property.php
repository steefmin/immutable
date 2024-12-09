<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

final class Property
{
    private PropertyName  $propertyName;

    private mixed $value;

    public static function create(string $propertyName, mixed $value): self
    {
        return new self(PropertyName::create($propertyName), $value);
    }

    private function __construct(
        PropertyName  $propertyName,
        mixed $value
    ) {
        $this->propertyName = $propertyName;
        $this->value = $value;
    }

    public function name(): PropertyName
    {
        return $this->propertyName;
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
