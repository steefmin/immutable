<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

final class PropertyName
{
    private string $value;

    public static function create(string $value): self
    {
        return new self($value);
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
