<?php

namespace Colorninja;

class ReflectionProperty
{
    /**
     * ReflectionProperty constructor.
     * @param array<string|class-string> $types
     * @param array $annotations
     */
    public function __construct(private array $types, private array $annotations)
    {
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }
}