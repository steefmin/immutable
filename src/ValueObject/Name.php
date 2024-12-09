<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject;

interface Name
{
    public function toString(): string;

    public function withoutPrefix(string $prefix): static;

    public function isEmpty(): bool;
}
