<?php

use Colorninja\Assert\NotNull;

include './vendor/autoload.php';

class TestDTO
{
    #[NotNull]
    public DateTimeInterface $dateTime;
}

$reader = new Colorninja\ReflectionReader(TestDTO::class);
$reader->getAttributes('dateTime');