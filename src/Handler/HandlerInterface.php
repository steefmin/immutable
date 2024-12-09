<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

interface HandlerInterface
{
    public function createsNewInstance(): bool;

    public function getNewInstanceArguments(Properties $properties, MethodName $methodName, Arguments $arguments): Arguments;

    public function canProvideFor(Properties $properties, MethodName $methodName, Arguments $arguments): bool;
}
