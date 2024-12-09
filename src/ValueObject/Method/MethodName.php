<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Method;

use SteefMin\Immutable\ValueObject\Stringable;

final class MethodName implements Stringable
{
    private function __construct(
        private readonly string $name,
    ) {
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function withoutPrefix(string $prefix): static
    {
        return new self(lcfirst(str_replace($prefix, '', $this->name)));
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function startsWith(string $prefix): bool
    {
        return str_starts_with($this->name, $prefix) && $this->withoutPrefix($prefix)->isNotEmpty();
    }

    public function valueEquals(string $string): bool
    {
        return $this->name === $string;
    }

    private function isNotEmpty(): bool
    {
        return ! $this->valueEquals('');
    }
}
