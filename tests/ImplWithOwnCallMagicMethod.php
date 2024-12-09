<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use SteefMin\Immutable\Immutable;

final class ImplWithOwnCallMagicMethod
{
    use Immutable {
        __call as protected immutable;
    }

    private readonly string $prop1;

    /** @var int[] */
    private readonly array $prop3;

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

    /** @param array<int, mixed> $args */
    public function __call(string $name, array $args): self
    {
        return $this->immutable($name, $args);
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
