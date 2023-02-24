<?php

declare(strict_types=1);

namespace Tests\Kata;

use Kata\Drink;
use Kata\FizzBuzz;
use Kata\MachineDriver;
use Kata\UserRequest;
use Kata\UserRequestBuilder;
use PHPUnit\Framework\TestCase;

class MachineDriverTest extends TestCase
{
    private MachineDriver $machineDriver;

    public function setUp(): void
    {
        parent::setUp();
        $this->machineDriver = new MachineDriver();
    }

    /** @test  @dataProvider process_user_requests_ */
    public function process_user_requests(UserRequest $userRequest, string $expectedCommand)
    {
        $this->assertEquals($expectedCommand, $this->machineDriver->process($userRequest));
    }

    /** @test */
    public function a_hot_drink_can_be_made_hot()
    {
        $drink = new Drink("Any", 0, true, "H::");

        $actualCommand = $drink->toCommand(true);

        $this->assertStringStartsWith("Hh:", $actualCommand);
    }

    /** @test */
    public function a_non_hot_drink_cannot_be_made_hot()
    {
        $drink = new Drink("Any", 0, false, "H::");

        $actualCommand = $drink->toCommand(true);

        $this->assertStringStartsWith("H:", $actualCommand);
    }

    private function process_user_requests_(): array
    {
        return [
            'With enough money, Drink maker makes 1 tea with 1 sugar and a stick' => [(new UserRequestBuilder())->tea()->withMoney(0.4)->withSugar()->build(), "T:1:0"],
            'With enough money, Drink maker makes 1 tea with 1 sugar and a stick, extra hot' => [(new UserRequestBuilder())->tea()->extraHot()->withMoney(0.4)->withSugar()->build(), "Th:1:0"],
            'Without enough money, Drink maker cannot make a tea' => [(new UserRequestBuilder())->tea()->withMoney(0.1)->withSugar()->build(), "M:missing-money:0.3"],

            'With enough money, Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [(new UserRequestBuilder())->chocolate()->withMoney(0.6)->withoutSugar()->build(), "H::"],
            'With enough money, Drink maker makes 1 chocolate with no sugar (extra hot)' => [(new UserRequestBuilder())->chocolate()->extraHot()->withMoney(0.6)->withoutSugar()->build(), "Hh::"],
            'Without enough money, Drink maker cannot make a chocolate' => [(new UserRequestBuilder())->chocolate()->withMoney(0.3)->withoutSugar()->build(), "M:missing-money:0.2"],
            'With enough money, Drink maker makes 1 coffee with 2 sugars and a stick' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->withMoney(0.6)->build(), "C:2:0"],
            'Without enough money, Drink maker cannot make a coffee' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->withMoney(0.1)->build(), "M:missing-money:0.5"],
            'With enough money, Drink maker makes 1 orange juice' => [(new UserRequestBuilder())->orangeJuice()->withMoney(0.6)->build(), "O::"],
            'Without enough money, Drink maker cannot make orange juice' => [(new UserRequestBuilder())->orangeJuice()->withMoney(0.3)->build(), "M:missing-money:0.3"],
            'With enough money, Drink maker forwards any message received onto the coffee machine interface for the customer to see' => [(new UserRequestBuilder())->printMessage("message-content")->build(), "M:message-content"],
        ];
    }

}
