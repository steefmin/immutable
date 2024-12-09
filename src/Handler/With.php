<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\ArgumentName;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;
use SteefMin\Immutable\ValueObject\Property\Property;
use SteefMin\Immutable\ValueObject\Property\PropertyName;

final class With implements HandlerInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function createsNewInstance(): bool
    {
        return true;
    }

    public function getNewInstanceArguments(Properties $properties, MethodName $name, Arguments $arguments): Arguments
    {
        $nameArgument = $arguments->first();
        $value = $nameArgument->value();

        assert(is_string($value), 'First argument must be a string');

        $propertyName = PropertyName::create($value);

        $property = $properties->getPropertyByName($propertyName);

        assert($property instanceof Property, sprintf('Property "%s" does not exist', $propertyName->toString()));

        $replacingArgument = $arguments
            ->second()
            ->withName(ArgumentName::create($value));

        return Arguments::create($properties->toArray())->replaceArgument($replacingArgument);
    }

    public function canProvideFor(MethodName $methodName, Arguments $arguments): bool
    {
        return $methodName->toString() === 'with' && $arguments->countEquals(2);
    }
}
