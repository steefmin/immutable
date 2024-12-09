<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\ArgumentName;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Name;
use SteefMin\Immutable\ValueObject\Property\Properties;
use SteefMin\Immutable\ValueObject\Property\PropertyName;

final class WithProperty implements HandlerInterface
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

    public function getNewInstanceArguments(Properties $properties, Name $name, Arguments $arguments): Arguments
    {
        $replacingPropertyName = $name->withoutPrefix('with');

        $properties->assertPropertyExists(PropertyName::create($replacingPropertyName->toString()));

        $replacingArgument = $arguments
            ->first()
            ->withName(ArgumentName::create($replacingPropertyName->toString()));

        return Arguments::create($properties->toArray())->replaceArgument($replacingArgument);
    }

    public function canProvideFor(MethodName $methodName, Arguments $arguments): bool
    {
        return $methodName->startsWith('with') && $arguments->countEquals(1);
    }
}
