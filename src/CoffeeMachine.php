<?php

declare(strict_types=1);

namespace Kata;

class CoffeeMachine
{
    public function process(UserRequest $input)
    {
        $drinkCommand = "";

        if ($input->drink === "message") {
            return "M:message-content";
        } elseif ($input->drink === "chocolate") {
            $drinkCommand = "H";
        } elseif ($input->drink === "coffee") {
            $drinkCommand = "C";
        } elseif ($input->drink === "tea") {
            $drinkCommand = "T";
        }

        $stickCommand = "";
        $sugarCommand = $input->sugar;
        if ("" != $drinkCommand) {
            $stickCommand = "";
            if ($sugarCommand === 0) {
                $sugarCommand = "";
            } else {
                $stickCommand = "0";
            }
        }

        return implode(":", [$drinkCommand, $sugarCommand, $stickCommand]);
    }
}