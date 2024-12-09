<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

final class NullHandler implements HandlerInterface
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
        return true;
    }

    public function createsNewInstance(): bool
    {
        return false;
    }

    public function getNewInstanceArguments(Properties $properties, MethodName $methodName, Arguments $arguments): Arguments
    {
        return Arguments::createEmpty();
    }
}
