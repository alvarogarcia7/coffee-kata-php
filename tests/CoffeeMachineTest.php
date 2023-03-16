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

    public function acceptance_tests_drinks()
    {
        return [
            'Drink maker makes 1 tea with 1 sugar and a stick' => [$this->newBuilder()->tea()->sugar(1), "T:1:0"],
            'Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [$this->newBuilder()->chocolate()->sugar(0), "H::"],
            'Drink maker makes 1 coffee with 2 sugars and a stick' => [$this->newBuilder()->coffee()->sugar(2), "C:2:0"],
            'Drink maker forwards any message received onto the coffee machine interface for the customer to see' => [$this->newBuilder()->message("message-content"), "M:message-content"]
        ];
    }

    private function newBuilder()
    {
        return new UserRequestBuilder();
    }
}
