<?php

namespace Colorninja;

use Colorninja\Normalizer\INormalizer;
use ReflectionException;

class Serializer
{
    /**
     * Serializer constructor.
     * @param INormalizer[] $normalizers The normalizers this serializer uses
     */
    public function __construct( array $normalizers ) { }

    public function serialize( mixed $dto ) : string
    {
        return 'asd';
    }

    /**
     * @template DtoType
     * @param string $data
     * @param class-string<DtoType> $className
     * @return DtoType
     *
     * @throws ReflectionException
     */
    public function deserialize( string $data, string $className )
    {
        $reader = new ReflectionReader($className);

        $dto = new $className;
        foreach ($reader->getPropertiesTypes() as $prop) {
            foreach ($prop as $types) {

            }
        }
        // Roadmap:
        // 1. Extract reflection reading into another class
        // 2. Add attribution validators

        return $dto;
    }


}