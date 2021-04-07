<?php

namespace Colorninja;

use Colorninja\Assert\NotNull;

class TestDTO
{
    public string $stringTest;

    public string $integerTest;

    #[NotNull]
    public string|int|float $unionTest;

}