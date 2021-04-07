<?php

namespace Colorninja\Assert;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class NotNull
{

    public function __construct(  )
    {
    }
}