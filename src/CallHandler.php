<?php

declare(strict_types=1);

namespace SteefMin\Immutable;

use SteefMin\Immutable\Handler\Resolver;
use SteefMin\Immutable\ValueObject\Argument\Arguments;
use SteefMin\Immutable\ValueObject\Method\MethodName;
use SteefMin\Immutable\ValueObject\Property\Properties;

final class CallHandler
{
    private readonly Resolver $resolver;

    private readonly MethodName $methodName;

    private readonly Arguments $arguments;

    private readonly Properties $properties;

    /**
     * @param array<string|int, mixed> $args
     * @param array<string, mixed> $props
     */
    private function __construct(
        string $name,
        array $args,
        array $props,
    ) {
        $this->resolver = Resolver::create();
        $this->methodName = MethodName::create($name);
        $this->arguments = Arguments::create($args);
        $this->properties = Properties::create($props);
    }

    /**
     * @template TClass
     * @param callable(Arguments $arguments): TClass $instanceCreator
     * @param callable(): never $failureCallback
     * @return TClass
     */
    public function __invoke(callable $instanceCreator, callable $failureCallback): mixed
    {
        $handler = $this->resolver->resolve($this->methodName, $this->arguments);

        if ($handler->createsNewInstance()) {
            $newInstanceArguments = $handler->getNewInstanceArguments(
                $this->properties,
                $this->methodName,
                $this->arguments,
            );

            return $instanceCreator($newInstanceArguments);
        }

        $failureCallback();
    }

    /**
     * @param array<string|int, mixed> $args
     * @param array<string, mixed> $props
     */
    public static function create(string $name, array $args, array $props): self
    {
        return new self($name, $args, $props);
    }
}
