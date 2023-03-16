<?php

declare(strict_types=1);

namespace Kata;

class CoffeeMachine
{

    private DrinkRepository $drinkRepository;

    public function __construct()
    {
        $this->drinkRepository = new DrinkRepository([
            new Drink("chocolate", "H", 0.5),
            new Drink("coffee", "C", 0.6),
            new Drink("tea", "T", 0.4),
        ]);
    }

    public function process(UserRequest $input)
    {
        if ($input->drink === "message") {
            return "M:message-content";
        }

        if (!$drink = $this->drinkRepository->findByName($input->drink)) {
            return "";
        }

        $drinkPrice = $drink->price;
        if ($input->insertedMoney < $drinkPrice) {
            $missingAmount = $drinkPrice - $input->insertedMoney;
            return "M:money-missing:{$missingAmount}";
        }
        $drinkCommand = $drink->shortHand;

        $sugarCommand = $input->sugar;
        $stickCommand = "";
        if ($sugarCommand === 0) {
            $sugarCommand = "";
        } else {
            $stickCommand = "0";
        }

        return implode(":", [$drinkCommand, $sugarCommand, $stickCommand]);
    }
}