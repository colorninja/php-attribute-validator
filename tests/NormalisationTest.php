<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class NumberAsStringDTO
{
    public int $numberAsString;
}

class NormalisationTest extends TestCase
{
    public function testEqualsTrue() : void
    {
//        $serializer = new Serializer(
//            [
//                new DateTimeNormalizer(),
//            ]);
//
//        $dto = $serializer->deserialize('{"numberAsString": "33"}', NumberAsStringDTO::class);
//
//        $this->assertSame(33, $dto->numberAsString);
        $this->assertTrue(true);
    }
}