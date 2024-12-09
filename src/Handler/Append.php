<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\Argument;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;
use SteefMin\Immutable\ValueObject\Property\Property;
use SteefMin\Immutable\ValueObject\Property\PropertyName;

final class Append implements HandlerInterface
{
    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function canProvideFor(Properties $properties, MethodName $methodName, Arguments $arguments): bool
    {
        return $methodName->toString() === 'append' && $arguments->countEquals(2);
    }

    public function createsNewInstance(): bool
    {
        return true;
    }

    public function getNewInstanceArguments(
        Properties $properties,
        MethodName $methodName,
        Arguments $arguments
    ): Arguments {
        $value = $arguments->first()->value();

        assert(is_string($value), 'First argument must be a string');

        $propertyName = PropertyName::create($value);

        $property = $properties->getPropertyByName($propertyName);

        assert($property instanceof Property, sprintf('Property "%s" does not exist', $propertyName->toString()));

        $replacingValue = $property->value();

        assert(is_array($replacingValue), 'Replacing value must be an array');

        $replacingValue[] = $arguments->second()->value();

        $replacingArgument = Argument::create($propertyName->toString(), $replacingValue);

        return Arguments::createFromArrayable($properties)->replaceArgument($replacingArgument);

    }
}
