<?php
declare(strict_types=1);

namespace Kata;

use function PHPUnit\Framework\throwException;

class MachineDriver
{
    private array $validDrinks;

    public function __construct()
    {
        $this->validDrinks = [new Drink("tea", 0.4),
            new Drink("coffee", 0.6),
            new Drink("chocolate", 0.5),
        ];
    }

    public function process(UserRequest $request)
    {
        if ($request->drink === "message") {
            return "M:{$request->message}";
        }
        if ($drink = $this->drinkByName($request->drink)) {
            if ($request->availableMoney < $drink->price) {
                $missingMoney = $drink->price - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }

            if ($request->drink === "chocolate") {
                return "H::";
            } elseif ($request->drink === "coffee") {
                return "C:2:0";
            }
            return "T:1:0";
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