<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\ArgumentName;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;
use SteefMin\Immutable\ValueObject\Property\Property;
use SteefMin\Immutable\ValueObject\Property\PropertyName;

final class WithProperty implements HandlerInterface
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
        return $methodName->startsWith('with') && $arguments->countEquals(1);
    }

    public function createsNewInstance(): bool
    {
        return true;
    }

    public function getNewInstanceArguments(Properties $properties, MethodName $methodName, Arguments $arguments): Arguments
    {
        $propertyName = PropertyName::createFromStringable($methodName->withoutPrefix('with'));

        $property = $properties->getPropertyByName($propertyName);

        assert($property instanceof Property, sprintf('Property "%s" does not exist', $propertyName->toString()));

        $replacingArgument = $arguments
            ->first()
            ->withName(ArgumentName::createFromStringable($propertyName));

        return Arguments::createFromArrayable($properties)->replaceArgument($replacingArgument);
    }
}
