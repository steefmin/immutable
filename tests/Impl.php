<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use SteefMin\Immutable\Immutable;

/**
 * @method self with(string $propertyName, mixed $value)
 * @method self withProp1(string $prop1)
 * @method self withProp2(int $prop2)
 */
final class Impl
{
    /** @use Immutable<array{prop1: string, prop2: int}> */
    use Immutable;

    private string $prop1;
    private int $prop2;

    public function __construct(
        string $prop1,
        int $prop2
    ) {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
    }

    public function getProp1(): string
    {
        return $this->prop1;
    }

    public function getProp2(): int
    {
        return $this->prop2;
    }
}
