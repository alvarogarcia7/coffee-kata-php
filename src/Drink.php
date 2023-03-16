<?php

namespace Kata;

class Drink
{
    public function __construct(public readonly string $name,
                                public readonly string $shortHand,
                                public readonly float  $price)
    {
    }
}