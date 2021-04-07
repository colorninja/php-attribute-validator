<?php

namespace Colorninja;

use Colorninja\Exception\ReaderException;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

class ReflectionReader
{
    private ReflectionClass $reflectionClass;

    /**
     * ReflectionReader constructor.
     * @param class-string $className
     * @throws ReflectionException
     */
    public function __construct( private string $className )
    {
        $this->reflectionClass = new ReflectionClass($className);
    }

    public function getPropertiesTypes() : array
    {
        return array_map(fn( $x ) => $this->_getPropertyTypes($x), $this->reflectionClass->getProperties());
    }

    public function getAttributes( string $name): array {
        print_r($this->reflectionClass->getProperty($name)->getAttributes()[0]->getName());
        die();
    }




    public function getPropertyTypes( string $name ) : array
    {
        $property = $this->reflectionClass->getProperty($name);

        return $this->_getPropertyTypes($property);
    }

    /**
     * @param ReflectionProperty $property
     * @return string[]
     * @throws ReaderException
     */
    private function _getPropertyTypes( ReflectionProperty $property ) : array
    {
        $type = $property->getType();

        if ($type instanceof ReflectionUnionType) {
            return array_map(fn( $x ) => $x->getName(), $type->getTypes());
        }

        if ($type instanceof ReflectionNamedType) {
            return [$type->getName()];
        }

        $name = $property->getName();
        throw new ReaderException("Please add a type to {$this->className}\${$name}");
    }

}