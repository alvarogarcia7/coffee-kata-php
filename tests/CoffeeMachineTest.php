<?php

declare(strict_types=1);

namespace Tests\Kata;

use Kata\CoffeeMachine;
use PHPUnit\Framework\TestCase;

class CoffeeMachineTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    public function setUp(): void
    {
        parent::setUp();
        $this->coffeeMachine = new CoffeeMachine();
    }

    /** @test
     * @dataProvider acceptance_tests_drinks
     */
    public function acceptance_tests(UserRequestBuilder $inputBuilder, string $expected)
    {
        $this->assertEquals($expected, $this->coffeeMachine->process($inputBuilder->build()));
    }

    /** @test */
    public function should_make_a_drink_with_zero_sugar()
    {
        $input = $this->newBuilder()->chocolate()->sugar(0);
        $this->assertStringEndsWith("::", $this->coffeeMachine->process($input->build()));
    }

    /** @test */
    public function should_include_a_stick_when_one_or_more_sugars()
    {
        $input = $this->newBuilder()->chocolate()->sugar(1);
        $this->assertStringEndsWith(":0", $this->coffeeMachine->process($input->build()));

        $input = $this->newBuilder()->chocolate()->sugar(2);
        $this->assertStringEndsWith(":0", $this->coffeeMachine->process($input->build()));
    }

    /** @test */
    public function should_not_make_extra_hot_drinks_for_drinks_that_do_not_support_extra_hot()
    {
        $input = $this->newBuilder()->orangeJuice()->extraHot();
        $this->assertStringNotContainsString("h", $this->coffeeMachine->process($input->build()));
    }

    public function acceptance_tests_drinks()
    {
        return [
            'Drink cannot make any drink if the inserted money is not enough' => [$this->newBuilder()->tea()->money(0.1)->sugar(1), "M:money-missing:0.3"],
            'Drink maker makes 1 tea with 1 sugar and a stick' => [$this->newBuilder()->tea()->sugar(1), "T:1:0"],
            'Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [$this->newBuilder()->chocolate()->sugar(0), "H::"],
            'Drink maker makes 1 coffee with 2 sugars and a stick' => [$this->newBuilder()->coffee()->sugar(2), "C:2:0"],
            'Drink maker will make an extra hot coffee with no sugar' => [$this->newBuilder()->coffee()->extraHot(), "Ch::"],
            'Drink maker will make one orange juice' => [$this->newBuilder()->orangeJuice(), "O::"],
            'Drink maker forwards any message received onto the coffee machine interface for the customer to see' => [$this->newBuilder()->message("message-content"), "M:message-content"]
        ];
    }

    private function newBuilder()
    {
        return new UserRequestBuilder();
    }
}
