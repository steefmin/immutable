<?php

declare(strict_types=1);

namespace SteefMin\Immutable\ValueObject;

/**
 * @template-covariant TKey of int|string
 * @template-covariant TValue
 */
interface Arrayable
{
    /** @return array<TKey, TValue> */
    public function toArray(): array;
}
