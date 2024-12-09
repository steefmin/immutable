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

    public function testReplaceSecondProp(): void
    {
        $subject = new Impl('a', 1);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $actual = $subject->withProp2(3);

        self::assertSame('a', $subject->getProp1());
        self::assertSame(1, $subject->getProp2());

        self::assertSame('a', $actual->getProp1());
        self::assertSame(3, $actual->getProp2());
    }

    public function testWith(): void
    {
        $subject = new Impl('a', 1);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);


        $actual = $subject->with('prop1', 'b');

        self::assertSame('a', $subject->getProp1());
        self::assertSame(1, $subject->getProp2());

        self::assertSame('b', $actual->getProp1());
        self::assertSame(1, $actual->getProp2());
    }
}
