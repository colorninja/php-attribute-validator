<?php

namespace Tests\Normalizer;

use Colorninja\Exception\NormalizeException;
use Colorninja\Normalizer\DateTimeNormalizer;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class DateTimeNormalizerTest extends TestCase
{
    private DateTimeNormalizer $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = $normalizer = new DateTimeNormalizer();
    }

    public function testNormalizesCorrectly(): void
    {
        $twentyTwenty = $this->normalizer->normalize("2020-01-01 00:00:00", DateTimeInterface::class);

        $this->assertSame($twentyTwenty->getTimestamp(), 1577836800);
    }


    public function testThrowsOnUnknownPrimitiveType(): void
    {
        $this->expectException(NormalizeException::class);
        $this->normalizer->normalize("2020-01-01 00:00:00", 'int');
    }

    public function testThrowsOnUnknownClass(): void
    {
        $this->expectException(NormalizeException::class);
        $this->normalizer->normalize("2020-01-01 00:00:00", DateTimeNormalizer::class);
    }

    public function testUsesDefaultNormalizerWhenDateTimeInterfaceUsed(): void
    {
        $normalizer = new DateTimeNormalizer(DateTime::class);

        $result = $normalizer->normalize("2020-01-01 00:00:00", DateTimeInterface::class);
        $this->assertInstanceOf(DateTime::class, $result);
    }
}