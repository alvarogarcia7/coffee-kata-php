<?php
declare(strict_types=1);

namespace Kata;

class MachineDriver
{
    public function process(UserRequest $request)
    {
        if ($request->drink === "message") {
            return "M:{$request->message}";
        }
        if ($request->drink === "chocolate") {
            return "H::";
        } elseif ($request->drink === "coffee") {
            return "C:2:0";
        }
        if ($request->availableMoney >= 0.4) {
            return "T:1:0";
        } else {
            $missingMoney = 0.4 - $request->availableMoney;
            return "M:missing-money:{$missingMoney}";
        }
    }
}