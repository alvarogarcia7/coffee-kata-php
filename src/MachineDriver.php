<?php
declare(strict_types=1);

namespace Kata;

class MachineDriver
{
    public function __construct(
        private readonly DrinkFactory $drinkFactory,
        private readonly DrinkLog $drinkLog,
        private readonly BeverageQuantityChecker $beverageQuantityChecker,
        private readonly EmailNotifier $emailNotifier
    )
    {
    }

    public function process(UserRequest $request)
    {
        $requestedDrink = $request->drink;
        if ($requestedDrink === "message") {
            return "M:{$request->message}";
        } elseif ($requestedDrink === "moneyReport"){
            $totalMoneyEarned = $this->drinkLog->totalAmountOfMoney();
            return "$:{$totalMoneyEarned}";
        }
        if ($drink = $this->drinkByName($requestedDrink)) {
            if ($request->availableMoney < $drink->price) {
                $missingMoney = $drink->price - $request->availableMoney;
                return "M:missing-money:{$missingMoney}";
            }
            if($this->beverageQuantityChecker->isEmpty($requestedDrink)){
                $this->emailNotifier->notifyMissingDrink($requestedDrink);
                return "M:Shortage of '{$requestedDrink}'. An email has been sent to management";
            }
            $this->drinkLog->append($request, $drink);
            return $drink->toCommand($request->extraHot, $request->sugar);
        }
        throw new \Exception();
    }

    private function drinkByName(string $drinkName): Drink|null
    {
        return $this->drinkFactory->drinkByName($drinkName);
    }
}

