<?php

namespace Kata;

class DrinkFactory
{
    private array $validDrinks;

    public function __construct()
    {
        $this->validDrinks = [
            new Drink("tea", 0.4, true, "T:1:0"),
            new Drink("coffee", 0.6, true, "C:2:0"),
            new Drink("chocolate", 0.5, true, "H::"),
            new Drink("orangeJuice", 0.6, false, "O::"),
        ];
    }

    public function drinkByName(string $drinkName): Drink|null
    {
        foreach ($this->validDrinks as $drink) {
            if ($drinkName === $drink->name) {
                return $drink;
            }
        }

        return null;

    }
}