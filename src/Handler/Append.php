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

    public function createsNewInstance(): bool
    {
        return true;
    }

    public function getNewInstanceArguments(Properties $properties, MethodName $name, Arguments $arguments): Arguments
    {
        $propertyName = PropertyName::createFromStringable($name->withoutPrefix('append'));

        $property = $properties->getPropertyByName($propertyName);

        assert($property instanceof Property, sprintf('Property "%s" does not exist', $propertyName->toString()));

        $appendingArgument = $arguments
            ->first();

        /** @var array<mixed> $replacingValue */
        $replacingValue = $property->value();

        $replacingValue[] = $appendingArgument->value();

        $replacingArgument = Argument::create($propertyName->toString(), $replacingValue);

        return Arguments::createFromArrayable($properties)->replaceArgument($replacingArgument);
    }

    public function canProvideFor(Properties $properties, MethodName $methodName, Arguments $arguments): bool
    {
        if ($methodName->startsWith('append') === false) {
            return false;
        }

        if (! $arguments->countEquals(1)) {
            return false;
        }

        $propertyName = PropertyName::createFromStringable($methodName->withoutPrefix('append'));

        $property = $properties->getPropertyByName($propertyName);

        if ($property === null) {
            return false;
        }

        return is_array($property->value());
    }
}
