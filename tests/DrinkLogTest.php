<?php

namespace Tests\Kata;

use Kata\Drink;
use Kata\DrinkLog;
use Kata\UserRequest;
use PHPUnit\Framework\TestCase;

class DrinkLogTest extends TestCase
{

    private DrinkLog $drinkLog;

    protected function setUp(): void
    {
        parent::setUp();
        $this->drinkLog = new DrinkLog();
    }

    /** @test */
    public function by_default__the_total_is_zero()
    {
        $this->assertEquals(0, $this->drinkLog->totalAmountOfMoney());
    }

    /** @test */
    public function with_drinks_inside__the_total_is_the_sum_of_their_prices()
    {
        $drink = new Drink("any", 0.1, false, "H");
        $request = new UserRequest();

        $this->drinkLog->append($request, $drink);
        $this->drinkLog->append($request, $drink);

        $this->assertEquals(2 * 0.1, $this->drinkLog->totalAmountOfMoney());
    }

}
