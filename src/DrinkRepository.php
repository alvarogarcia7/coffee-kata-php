<?php

namespace Kata;

class DrinkRepository
{
    /**
     * @param Drink[] $drinks
     */
    public function __construct(private readonly array $drinks)
    {
    }

    public function findByName(string $name): Drink|null
    {
        foreach ($this->drinks as $drink){
            if($drink->name === $name){
                return $drink;
            }
        }
        return null;
    }
}