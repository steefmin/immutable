<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

/**
 * @implements \IteratorAggregate<int, Argument>
 */
final class Arguments implements \IteratorAggregate, \Countable
{
    /** @var Argument[] */
    private array $arguments;

    private function __construct()
    {
        $this->arguments = [];
    }

    /** @param array<string|int, mixed> $args */
    public static function create(array $args): self
    {
        $self = new self();
        foreach ($args as $name => $arg) {
            $self = $self->appendArgument(Argument::create((string) $name, $arg));
        }
        return $self;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    /** @return \ArrayIterator<int, Argument> */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count(): int
    {
        return count($this->arguments);
    }

    public function first(): Argument
    {
        return $this->arguments[0];
    }

    public function second(): Argument
    {
        return $this->arguments[1];
    }

    private function appendArgument(Argument $argument): self
    {
        $self = clone $this;
        $self->arguments[] = $argument;
        return $self;
    }

    public function replaceArgument(Argument $replacingArgument): self
    {
        $result = new self();

        /** @var Argument $existingArg */
        foreach ($this->arguments as $existingArg) {
            if ($existingArg->name()->equals($replacingArgument->name())) {
                $result = $result->appendArgument($replacingArgument);
            } else {
                $result = $result->appendArgument($existingArg);
            }
        }

        return $result;
    }

    /** @return array<string, mixed> */
    public function toList(): array
    {
        $result = [];

        /** @var Argument $argument */
        foreach ($this->arguments as $argument) {
            $result[$argument->name()->toString()] = $argument->value();
        }

        return $result;
    }

    public function countEquals(int $int): bool
    {
        return $this->count() === $int;
    }
}
