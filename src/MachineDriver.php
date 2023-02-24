<?php
declare(strict_types=1);

namespace Kata;

use function PHPUnit\Framework\throwException;

class MachineDriver
{
    private array $validDrinks;

    public function __construct()
    {
        $this->validDrinks = [new Drink("tea", 0.4, true, ""),
            new Drink("coffee", 0.6, true, "C:2:0"),
            new Drink("chocolate", 0.5, true, "H::"),
            new Drink("orangeJuice", 0.6, false, ""),
        ];
    }

    public function process(UserRequest $request)
    {
        $requestedDrink = $request->drink;
        if ($requestedDrink === "message") {
            return "M:{$request->message}";
        }
        if ($drink = $this->drinkByName($requestedDrink)) {
            if ($request->availableMoney < $drink->price) {
                $missingMoney = $drink->price - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }

            if ($requestedDrink === "chocolate") {
                return $drink->toCommand($request->extraHot);
            } elseif ($requestedDrink === "coffee") {
                return $drink->toCommand($request->extraHot);
            } elseif ($requestedDrink === "orangeJuice") {
                return "O::";
            }
            $drink = "T";
            if ($request->extraHot) {
                $drink = "Th";
            }
            return "{$drink}:1:0";
        }
        throw new \Exception();
    }

    private function drinkByName(string $drinkName): Drink|null
    {
        foreach ($this->validDrinks as $drink) {
            if ($drinkName === $drink->name) {
                return $drink;
            }
        }

        return null;

    }
}