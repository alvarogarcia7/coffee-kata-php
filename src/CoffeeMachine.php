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
        $drinkCommand = "";

        if ($input->drink === "message") {
            return "M:message-content";
        } elseif ($input->drink === "chocolate") {
            $drinkCommand = "H";
        } elseif ($input->drink === "coffee") {
            $drinkCommand = "C";
        } elseif ($input->drink === "tea") {
            if($drink = $this->drinkRepository->findByName($input->drink)){
                $teaPrice = $drink->price;
                if ($input->insertedMoney < $teaPrice) {
                    $missingAmount = $teaPrice - $input->insertedMoney;
                    return "M:money-missing:{$missingAmount}";
                }
                $drinkCommand = $drink->shortHand;
            }
        }

        $stickCommand = "";
        $sugarCommand = $input->sugar;
        if ("" != $drinkCommand) {
            $stickCommand = "";
            if ($sugarCommand === 0) {
                $sugarCommand = "";
            } else {
                $stickCommand = "0";
            }
        }

        return implode(":", [$drinkCommand, $sugarCommand, $stickCommand]);
    }
}