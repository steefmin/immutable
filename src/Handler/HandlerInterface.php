<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

interface HandlerInterface
{
    public function createsNewInstance(): bool;

    public function getNewInstanceArguments(Properties $properties, MethodName $name, Arguments $arguments): Arguments;

    public function canProvideFor(MethodName $methodName): bool;
}
