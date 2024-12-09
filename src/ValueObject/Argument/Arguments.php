<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject\Argument;

use SteefMin\Immutable\ValueObject\Arrayable;

/**
 * @implements \IteratorAggregate<int, Argument>
 */
final class Arguments implements \IteratorAggregate, \Countable
{
    /** @param Argument[] $arguments */
    private function __construct(
        private readonly array $arguments,
    ) {
    }

    /** @param array<string|int, mixed> $args */
    public static function create(array $args): self
    {
        $self = self::createEmpty();
        foreach ($args as $name => $arg) {
            $self = $self->appendArgument(Argument::create((string) $name, $arg));
        }
        return $self;
    }

    /** @param Arrayable<string|int, mixed> $arrayable */
    public static function createFromArrayable(Arrayable $arrayable): self
    {
        return self::create($arrayable->toArray());
    }

    public static function createEmpty(): self
    {
        return new self([]);
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
        assert(array_key_exists(0, $this->arguments));
        return $this->arguments[0];
    }

    public function second(): Argument
    {
        assert(array_key_exists(1, $this->arguments));
        return $this->arguments[1];
    }

    public function replaceArgument(Argument $replacingArgument): self
    {
        $result = self::createEmpty();

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

        foreach ($this->arguments as $argument) {
            $result[$argument->name()->toString()] = $argument->value();
        }

        return $result;
    }

    public function countEquals(int $int): bool
    {
        return $this->count() === $int;
    }

    private function appendArgument(Argument $argument): self
    {
        $arguments = $this->arguments;
        $arguments[] = $argument;
        return new self($arguments);
    }
}
