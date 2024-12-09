<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use PHPUnit\Framework\TestCase;

final class WithTest extends TestCase
{
    public function testWith(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $actual = $subject->with('prop1', 'b');

        self::assertInstanceOf(Impl::class, $actual);

        self::assertSame('a', $subject->getProp1());
        self::assertSame(1, $subject->getProp2());

        self::assertSame('b', $actual->getProp1());
        self::assertSame(1, $actual->getProp2());
    }

    public function testInvalidPropertyName(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $this->expectException(\AssertionError::class);
        $subject->with('propA', 'b');
    }

    public function testInvalidPropertyNameType(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $this->expectException(\AssertionError::class);
        $subject->with(1, 'b'); // @phpstan-ignore argument.type
    }

    public function testInvalidArgumentCount(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $this->expectException(\BadMethodCallException::class);
        $subject->with('propA', 'b', 'c'); // @phpstan-ignore arguments.count
    }
}
