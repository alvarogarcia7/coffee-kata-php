<?php

declare(strict_types=1);

namespace Kata;

class CoffeeMachine
{
    public function process(UserRequest $input)
    {
        $drinkCommand = "";
        $sugarCommand = "";
        if ($input->drink === "message") {
            return "M:message-content";
        } elseif ($input->drink === "chocolate") {
            $drinkCommand = "H";
            $sugarCommand = $input->sugar;
        } elseif ($input->drink === "coffee") {
            $drinkCommand = "C";
            $sugarCommand = "2";
        } elseif ($input->drink === "tea") {
            $drinkCommand = "T";
            $sugarCommand = "1";
        }

        if ("" != $drinkCommand) {
            $stickCommand = "";
            if ($sugarCommand === 0) {
                $sugarCommand = "";
            } else {
                $stickCommand = "0";
            }
            return implode(":", [$drinkCommand, $sugarCommand, $stickCommand]);
        }


        throw new \Exception("This request is not supported: $input");
    }
}