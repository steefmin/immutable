<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;

final class Resolver
{
    /** @var HandlerInterface[] */
    private readonly array $handlers;

    private function __construct(
        HandlerInterface ...$handlers
    ) {
        $this->handlers = $handlers;
    }

    public static function create(): self
    {
        return new self(
            With::create(),
            WithProperty::create(),
        );
    }

    public function resolve(MethodName $methodName, Arguments $arguments): HandlerInterface
    {
        foreach ($this->handlers as $handler) {
            if ($handler->canProvideFor($methodName, $arguments)) {
                return $handler;
            }
        }

        return NullHandler::create();
    }
}
