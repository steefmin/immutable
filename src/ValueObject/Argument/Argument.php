<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

final class Argument
{
    private ArgumentName $name;

    /** @var mixed */
    private $value;

    /** @param mixed $value */
    public static function create(string $name, $value): self
    {
        return new self(ArgumentName::create($name), $value);
    }

    /** @param mixed $value */
    private function __construct(ArgumentName $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function name(): ArgumentName
    {
        return $this->name;
    }

    /** @return mixed */
    public function value()
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
