<?php

namespace Tests;

use Colorninja\ReflectionReader;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class AbstractId
{
    public int $id;

    private function __construct( int $id )
    {
        $this->id = $id;
    }

    public static function fromInt( int $id ) : self
    {
        return new self($id);
    }
}

class ReflectionDTO
{
    public string $stringProp;
    public int $intProp;
    public int|string $unionProp;
    public int|string|float|bool $unionProp2;
}

class ComplexReflectionDTO
{
    public DateTimeImmutable $createdAt;
    public DateTimeInterface $updatedAt;
}

class ReflectionReaderTest extends TestCase
{
    public function testExtractsBuiltInTypesCorrectly() : void
    {
        $reader = new ReflectionReader(ReflectionDTO::class);

        $this->assertIsArray($reader->getPropertyTypes('stringProp'));
        // string prop
        $intPropTypes = $reader->getPropertyTypes('intProp');
        $this->assertCount(1, $intPropTypes);
        $this->assertContains('string', $reader->getPropertyTypes('stringProp'));

        // int prop
        $intPropTypes = $reader->getPropertyTypes('intProp');
        $this->assertCount(1, $intPropTypes);
        $this->assertContains('int', $intPropTypes);

        // union prop
        $unionPropTypes = $reader->getPropertyTypes('unionProp');
        $this->assertCount(2, $unionPropTypes);
        $this->assertContains('int', $unionPropTypes);
        $this->assertContains('string', $unionPropTypes);
        $this->assertNotContains('bool', $unionPropTypes);
        $this->assertNotContains('float', $unionPropTypes);

        // union prop 2
        $unionPropTypes2 = $reader->getPropertyTypes('unionProp2');
        $this->assertCount(4, $unionPropTypes2);
        $this->assertContains('int', $unionPropTypes2);
        $this->assertContains('string', $unionPropTypes2);
        $this->assertContains('bool', $unionPropTypes2);
        $this->assertContains('float', $unionPropTypes2);
    }

    public function testExtractsComplexTypesCorrectly() : void
    {
        $reader = new ReflectionReader(ComplexReflectionDTO::class);

        // DateTimeImmutable
        $createdAt = $reader->getPropertyTypes('createdAt');
        $this->assertIsArray($createdAt);
        $this->assertContains(DateTimeImmutable::class, $createdAt);

        $updatedAt = $reader->getPropertyTypes('updatedAt');
        $this->assertIsArray($updatedAt);
        $this->assertContains(DateTimeInterface::class, $updatedAt);

    }

}