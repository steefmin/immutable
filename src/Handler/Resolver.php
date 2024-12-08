<?php

declare(strict_types=1);

namespace SteefMin\Immutable\Handler;

use SteefMin\Immutable\ValueObject\Method\MethodName;

final class Resolver
{
    /** @var HandlerInterface[] */
    private array $handlers;

    public static function create(): self
    {
        return new self(
            With::create(),
        );
    }

    private function __construct(
        HandlerInterface ...$handlers
    ) {
        $this->handlers = $handlers;
    }

    public function resolve(MethodName $methodName): HandlerInterface
    {
        foreach ($this->handlers as $handler) {
            if ($handler->canProvideFor($methodName)) {
                return $handler;
            }
        }

        return NullHandler::create();
    }
}
