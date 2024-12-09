<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use SteefMin\Immutable\Immutable;

/**
 * @method self withProp1(string $prop1)
 * @method self withProp2(int $prop2)
 */
final class Impl
{
    /** @use Immutable<array{prop1: string, prop2: int, prop3: int[]}> */
    use Immutable;

    private string $prop1;

    /** @var int[] */
    private array $prop3;

    private int $prop2;

    /** @param int[] $prop3 */
    public function __construct(
        string $prop1,
        int $prop2,
        array $prop3,
    ) {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        $this->prop3 = $prop3;
    }

    public function getProp1(): string
    {
        return $this->prop1;
    }

    public function getProp2(): int
    {
        return $this->prop2;
    }

    /** @return int[] */
    public function getProp3(): array
    {
        return $this->prop3;
    }
}
