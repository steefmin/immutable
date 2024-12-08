<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\ArgumentName;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;
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
        $replacingPropteryName = $name->withoutPrefix('with');

        $properties->assertPropertyExists(PropertyName::create($replacingPropteryName->toString()));

        $arguments->assertCount(1, 'Can only update one argument at a time');

        $replacingArgument = $arguments
            ->first()
            ->withArgumentName(ArgumentName::create($replacingPropteryName->toString()));

        return Arguments::create($properties->toArray())->replaceArgument($replacingArgument);
    }

    public function canProvideFor(MethodName $methodName): bool
    {
        return $methodName->startsWith('with');
    }
}
