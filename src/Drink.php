<?php

namespace Kata;

class Drink
{

    public function __construct(public readonly string $name, public readonly float $price)
    {
    }
}