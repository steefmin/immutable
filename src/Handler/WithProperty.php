<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\ArgumentName;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Name;
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

    public function createsNewInstance(): bool
    {
        return true;
    }

    public function getNewInstanceArguments(Properties $properties, Name $name, Arguments $arguments): Arguments
    {
        $propertyName = PropertyName::create($name->withoutPrefix('with')->toString());

        $property = $properties->getPropertyByName($propertyName);

        assert($property instanceof Property, sprintf('Property "%s" does not exist', $propertyName->toString()));

        $replacingArgument = $arguments
            ->first()
            ->withName(ArgumentName::create($propertyName->toString()));

        return Arguments::create($properties->toArray())->replaceArgument($replacingArgument);
    }

    public function canProvideFor(MethodName $methodName, Arguments $arguments): bool
    {
        return $methodName->startsWith('with') && $arguments->countEquals(1);
    }
}
