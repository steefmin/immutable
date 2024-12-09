<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

final class Argument
{
    private ArgumentName $name;

    private mixed $value;

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

    public function withArgumentName(ArgumentName $name): self
    {
        $self = clone $this;
        $self->name = $name;
        return $self;
    }
}
