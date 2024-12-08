<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Method;

final class MethodName
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

    public function withoutPrefix(string $string): self
    {
        return new self(lcfirst(str_replace($string, '', $this->name)));
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function startsWith(string $prefix): bool
    {
        return strpos($this->name, $prefix) === 0;
    }
}
