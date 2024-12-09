<?php

namespace SteefMin\Immutable;

use BadMethodCallException;
use ReflectionClass;
use ReflectionProperty;
use SteefMin\Immutable\Handler\Resolver;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

/**
 * @immutable
 * @template-covariant TClass of object
 * @template-covariant TProps of array<string, mixed>
 */
trait Immutable
{
    /**
     * Implements all with<PropertyName> methods on the class that uses this trait
     * @param array<int, mixed> $args
     * @return TClass
     */
    public function __call(string $name, array $args): self
    {
        $resolver = Resolver::create();
        $methodName = MethodName::create($name);
        $methodArguments = Arguments::create($args);

        $handler = $resolver->resolve($methodName);

        if ($handler->createsNewInstance()) {
            $props = (new ReflectionClass($this))->getProperties();

            $propertyKeys = array_map(fn(ReflectionProperty $property) => $property->getName(), $props);
            $propertyValues = array_values(get_object_vars($this));

            $properties = array_combine($propertyKeys, $propertyValues);
            $properties = Properties::create($properties);

            /** @var TProps $instanceArguments */
            $instanceArguments = $handler
                ->getNewInstanceArguments($properties, $methodName, $methodArguments)
                ->toList();

            return new self(...$instanceArguments);
        }

        throw new BadMethodCallException();
    }
}
