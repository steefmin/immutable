<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Method;

use SteefMin\Immutable\ValueObject\Name;

final class MethodName implements Name
{
    private string $name;

    public static function create(string $name): self
    {
        return new self($name);
    }

    private function __construct(string $name)
    {
        $this->name = $name;
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

    public function isEmpty(): bool
    {
        return $this->name === '';
    }

    private function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }
}
