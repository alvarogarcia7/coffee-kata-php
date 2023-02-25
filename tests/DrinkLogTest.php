<?php

namespace Tests\Kata;

use Kata\DrinkLog;
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

}
