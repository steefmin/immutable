<?php

namespace SteefMin\Immutable;

use BadMethodCallException;
use SteefMin\Immutable\Handler\Resolver;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

/**
 * @immutable
 * @template-covariant TProps of array<string, mixed>
 */
trait Immutable
{
    /**
     * Implements all with<PropertyName> methods on the class that uses this trait
     * @param array<int, mixed> $args
     */
    public function __call(string $name, array $args): static
    {
        $resolver = Resolver::create();
        $methodName = MethodName::create($name);
        $methodArguments = Arguments::create($args);

        $handler = $resolver->resolve($methodName, $methodArguments);

        if ($handler->createsNewInstance()) {
            $properties = Properties::create(get_object_vars($this));

            /** @var TProps $instanceArguments */
            $instanceArguments = $handler
                ->getNewInstanceArguments($properties, $methodName, $methodArguments)
                ->toList();

            return new self(...$instanceArguments);
        }

        throw new BadMethodCallException();
    }
}
