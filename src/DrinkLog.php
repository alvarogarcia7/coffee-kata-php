<?php

namespace Kata;

class DrinkLog
{
    private array $interactions = [];

    public function append(UserRequest $request, Drink $drink)
    {
        $this->interactions[] = [$request, $drink];
    }

    public function totalAmountOfMoney(): float
    {
        $prices = array_map(function ($element) {
            return $element[1]->price;
        }, $this->interactions);
        return array_sum($prices);

    }

}