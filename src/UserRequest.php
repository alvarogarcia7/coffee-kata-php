<?php

namespace Kata;

class UserRequest
{
    public function __construct(
        public readonly string $drink,
        public readonly int    $sugar,
        public readonly float  $insertedMoney,
        public readonly bool   $extraHot
    )
    {

    }

}