<?php

namespace Colorninja\Normalizer;

interface INormalizer
{
    public function normalize( mixed $value, string $type ) : mixed;
    public function getSupportedTypes() : array;
}