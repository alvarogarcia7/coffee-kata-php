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
            $price = 0.5;
            if ($request->availableMoney >= $price) {
                return "H::";
            } else {
                $missingMoney = $price - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }
        } elseif ($request->drink === "coffee") {
            $price = 0.6;
            if ($request->availableMoney >= $price) {
                return "C:2:0";
            } else {
                $missingMoney = $price - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }
        }
        $price = 0.4;
        if ($request->availableMoney >= $price) {
            return "T:1:0";
        } else {
            $missingMoney = $price - $request->availableMoney;
            return "M:missing-money:{$missingMoney}";
        }
    }
}