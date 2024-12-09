<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

final class ArgumentName
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name): self
    {
        return new self($name);
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
