<?php

declare(strict_types=1);

namespace Kata;

class CoffeeMachine
{
    public function process(UserRequest $input)
    {
        if ($input->drink === "message") {
            return "M:message-content";
        } elseif ($input->drink === "chocolate") {
            return "H::";
        } elseif ($input->drink === "coffee") {
            return "C:2:0";
        } elseif ($input->drink === "tea") {
            return "T:1:0";
        }

    }
}