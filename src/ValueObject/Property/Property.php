<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

final class Property
{
    private function __construct(
        private readonly PropertyName $propertyName,
        private readonly mixed $value,
    ) {
    }

    public static function create(string $propertyName, mixed $value): self
    {
        return new self(PropertyName::create($propertyName), $value);
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
