<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;


final class Argument
{
    private readonly ArgumentName $name;
    private readonly mixed $value;

    public static function create(string $name, mixed $value): self
    {
        return new self(ArgumentName::create($name), $value);
    }

    private function __construct(ArgumentName $name, mixed $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function name(): ArgumentName
    {
        return $this->name;
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public function withName(ArgumentName $name): self
    {
        return new self($name, $this->value);
    }
}
