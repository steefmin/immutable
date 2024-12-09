<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

use SteefMin\Immutable\ValueObject\Stringable;

final class ArgumentName
{
    private function __construct(
        private readonly string $name,
    ) {
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public static function createFromStringable(Stringable $stringable): self
    {
        return new self($stringable->toString());
    }

    public function equals(self $other): bool
    {
        return $this->name === $other->name;
    }

    public function toString(): string
    {
        return $this->name;
    }
}
