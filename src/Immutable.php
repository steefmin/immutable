<?php

declare(strict_types=1);

namespace SteefMin\Immutable;

use BadMethodCallException;
use SteefMin\Immutable\ValueObject\Argument\Arguments;

/**
 * @immutable
 * @method static with(string $propertyName, mixed $value)
 * @method static append(string $propertyName, mixed $value)
 */
trait Immutable
{
    /**
     * Implements all with<PropertyName> methods on the class that uses this trait
     * @param array<int, mixed> $args
     */
    public function __call(string $name, array $args): static
    {
        $callHandler = CallHandler::create($name, $args, get_object_vars($this));

        return $callHandler(
            fn (Arguments $arguments) => new static(...$arguments->toList()), // @phpstan-ignore argument.type
            fn () => throw new BadMethodCallException(),
        );
    }
}
