<?php

declare(strict_types=1);

namespace SteefMin\Tests\Immutable;

use PHPUnit\Framework\TestCase;

final class AppendTest extends TestCase
{
    public function testAppend(): void
    {
        $subject = new Impl('a', 1, [1]);

        $actual = $subject->append('prop3', 2);

        self::assertInstanceOf(Impl::class, $actual);

        self::assertSame([1, 2], $actual->getProp3());
    }

    public function testAppendOtherTypeIsNotPrevented(): void
    {
        $subject = new Impl('a', 1, [1]);

        $actual = $subject->append('prop3', '2');

        self::assertInstanceOf(Impl::class, $actual);

        self::assertSame([1, '2'], $actual->getProp3());
    }

    public function testInvalidPropertyName(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $this->expectException(\AssertionError::class);
        $subject->append('propA', 'b');
    }

    public function testWInvalidArgumentCount(): void
    {
        $subject = new Impl('a', 1, []);

        $clone = clone $subject;

        self::assertNotSame($subject, $clone);
        self::assertEquals($subject, $clone);

        $this->expectException(\BadMethodCallException::class);
        $subject->append('prop3', 2, 3); // @phpstan-ignore arguments.count
    }
}
