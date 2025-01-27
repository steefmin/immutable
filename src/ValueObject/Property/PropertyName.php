<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Property;

use SteefMin\Immutable\ValueObject\Stringable;

final class PropertyName implements Stringable
{
    private function __construct(
        private readonly string $value,
    ) {
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public static function createFromStringable(Stringable $stringable): self
    {
        return self::create($stringable->toString());
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
