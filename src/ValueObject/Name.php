<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject;

interface Name extends Stringable
{
    public function withoutPrefix(string $prefix): static;

    public function isEmpty(): bool;
}
