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
            $teaPrice = 0.5;
            if ($request->availableMoney >= $teaPrice) {
                return "H::";
            } else {
                $missingMoney = $teaPrice - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }
        } elseif ($request->drink === "coffee") {
            $teaPrice = 0.6;
            if ($request->availableMoney >= $teaPrice) {
                return "C:2:0";
            } else {
                $missingMoney = $teaPrice - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }
        }
        $teaPrice = 0.4;
        if ($request->availableMoney >= $teaPrice) {
            return "T:1:0";
        } else {
            $missingMoney = $teaPrice - $request->availableMoney;
            return "M:missing-money:{$missingMoney}";
        }
    }
}