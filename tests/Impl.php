<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use SteefMin\Immutable\Immutable;

final class Impl
{
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
