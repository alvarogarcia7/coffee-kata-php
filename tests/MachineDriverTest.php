<?php

declare(strict_types=1);

namespace Tests\Kata;

use Kata\BeverageQuantityChecker;
use Kata\Drink;
use Kata\DrinkFactory;
use Kata\DrinkLog;
use Kata\EmailNotifier;
use Kata\FizzBuzz;
use Kata\MachineDriver;
use Kata\UserRequest;
use Kata\UserRequestBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophet;

class MachineDriverTest extends TestCase
{
    private MachineDriver $machineDriver;
    private Prophet $prophet;
    private DrinkLog $drinkLog;
    private \Prophecy\Prophecy\ObjectProphecy|BeverageQuantityChecker $mockBeverageQuantityChecker;
    private EmailNotifier|\Prophecy\Prophecy\ObjectProphecy $mockEmailNotifier;

    public function setUp(): void
    {
        parent::setUp();
        $this->drinkLog = new DrinkLog();
        $this->machineDriver = new MachineDriver(new DrinkFactory(), $this->drinkLog);
        $this->prophet = new Prophet();
        $this->mockBeverageQuantityChecker = $this->prophet->prophesize(BeverageQuantityChecker::class);
        $this->mockEmailNotifier = $this->prophet->prophesize(EmailNotifier::class);
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

        $actualCommand = $drink->toCommand(true, 0);

        $this->assertStringStartsWith("Hh:", $actualCommand);
    }

    /** @test */
    public function a_non_hot_drink_cannot_be_made_hot()
    {
        $drink = new Drink("Any", 0, false, "H::");

        $actualCommand = $drink->toCommand(true, 0);

        $this->assertStringStartsWith("H:", $actualCommand);
    }

    /** @test */
    public function the_driver_delegates_the_building_of_the_drink_to_the_factory()
    {
        $drinkFactory = $this->prophet->prophesize(DrinkFactory::class);
        $this->machineDriver = new MachineDriver($drinkFactory->reveal(), new DrinkLog());
        $drinkFactory->drinkByName(Argument::any())->willReturn(new Drink('tea', 0.1, true, "T::"));
        $userRequest = (new UserRequestBuilder())->tea()->withMoney(0.4)->extraHot()->build();

        $command = $this->machineDriver->process($userRequest);

        $drinkFactory->drinkByName("tea")->shouldHaveBeenCalled();
        $this->assertEquals("Th::", $command);
    }

    /** @test */
    public function store_the_drink_request_for_statistics()
    {
        $drinkFactory = $this->prophet->prophesize(DrinkFactory::class);
        $drinkLog = $this->prophet->prophesize(DrinkLog::class);
        $this->machineDriver = new MachineDriver($drinkFactory->reveal(), $drinkLog->reveal());
        $drink = new Drink('tea', 0.1, true, "T::");
        $drinkFactory->drinkByName(Argument::any())->willReturn($drink);
        $userRequest = (new UserRequestBuilder())->tea()->withMoney(0.4)->extraHot()->build();

        $this->machineDriver->process($userRequest);

        $drinkLog->append($userRequest, $drink)->shouldHaveBeenCalled();
        $this->prophet->checkPredictions();
        $this->assertTrue(true);
    }

    /** @test */
    public function request_if_the_drink_can_be_made()
    {
        $this->machineDriver = new MachineDriver(new DrinkFactory(), $this->drinkLog, $this->mockBeverageQuantityChecker->reveal(), $this->mockEmailNotifier->reveal());
        $userRequest = (new UserRequestBuilder())->tea()->withMoney(0.4)->extraHot()->build();
        $this->mockBeverageQuantityChecker->isEmpty(Argument::any())->willReturn(true);

        $this->machineDriver->process($userRequest);

        $this->mockBeverageQuantityChecker->isEmpty(Argument::any())->shouldHaveBeenCalled();
        $this->prophet->checkPredictions();
        $this->assertTrue(true);
    }


    /** @test */
    public function print_the_money_report()
    {
        $this->drinkLog->append(new UserRequest(), new Drink('any', 0.4, false, 'X::'));
        $userRequest = (new UserRequestBuilder())->printMoneyReport()->build();

        $command = $this->machineDriver->process($userRequest);

        $this->assertEquals("$:0.4", $command);
    }

    private function process_user_requests_(): array
    {
        return [
//            Tea
            'With enough money, Drink maker makes 1 tea with 1 sugar and a stick' => [(new UserRequestBuilder())->tea()->withMoney(0.4)->withSugar()->build(), "T:1:0"],
            'With enough money, Drink maker makes 1 tea with 1 sugar and a stick, extra hot' => [(new UserRequestBuilder())->tea()->extraHot()->withMoney(0.4)->withSugar()->build(), "Th:1:0"],
            'With enough money, The drink maker will make an extra hot tea with two sugar and a stick' => [(new UserRequestBuilder())->tea()->extraHot()->withMoney(0.4)->withSugar()->withSugar()->build(), "Th:2:0"],
            'Without enough money, Drink maker cannot make a tea' => [(new UserRequestBuilder())->tea()->withMoney(0.1)->withSugar()->build(), "M:missing-money:0.3"],

//            Chocolate
            'With enough money, Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [(new UserRequestBuilder())->chocolate()->withMoney(0.6)->withoutSugar()->build(), "H::"],
            'With enough money, Drink maker makes 1 chocolate with no sugar (extra hot)' => [(new UserRequestBuilder())->chocolate()->extraHot()->withMoney(0.6)->withoutSugar()->build(), "Hh::"],
            'With enough money, Drink maker will make an extra hot chocolate with one sugar and a stick' => [(new UserRequestBuilder())->chocolate()->extraHot()->withMoney(0.6)->withSugar()->build(), "Hh:1:0"],
            'Without enough money, Drink maker cannot make a chocolate' => [(new UserRequestBuilder())->chocolate()->withMoney(0.3)->withoutSugar()->build(), "M:missing-money:0.2"],

//            Coffee
            'With enough money, Drink maker makes 1 coffee with 2 sugars and a stick' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->withMoney(0.6)->build(), "C:2:0"],
            'With enough money, Drink maker makes 1 coffee with 2 sugars and a stick (extra hot)' => [(new UserRequestBuilder())->coffee()->extraHot()->withSugar()->withSugar()->withMoney(0.6)->build(), "Ch:2:0"],
            'Drink maker will make an extra hot coffee with no sugar' => [(new UserRequestBuilder())->coffee()->extraHot()->withoutSugar()->withMoney(0.6)->build(), "Ch::"],
            'Without enough money, Drink maker cannot make a coffee' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->withMoney(0.1)->build(), "M:missing-money:0.5"],

//            Orange Juice
            'With enough money, Drink maker makes 1 orange juice' => [(new UserRequestBuilder())->orangeJuice()->withMoney(0.6)->build(), "O::"],
            'Without enough money, Drink maker cannot make orange juice' => [(new UserRequestBuilder())->orangeJuice()->withMoney(0.3)->build(), "M:missing-money:0.3"],

//            Message
            'With enough money, Drink maker forwards any message received onto the coffee machine interface for the customer to see' => [(new UserRequestBuilder())->printMessage("message-content")->build(), "M:message-content"],

        ];
    }

}
