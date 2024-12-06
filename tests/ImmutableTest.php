<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use PHPUnit\Framework\TestCase;

final class ImmutableTest extends TestCase
{
    public function testCreatesNewInstance(): void
    {
        $subject = new Impl('a', 1);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $actual = $subject->withProp1('b');

        self::assertSame('a', $subject->getProp1());
        self::assertSame(1, $subject->getProp2());

        self::assertSame('b', $actual->getProp1());
        self::assertSame(1, $actual->getProp2());
    }
}
