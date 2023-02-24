<?php

declare(strict_types=1);

namespace Tests\Kata;

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

    /** @test  @dataProvider make_drinks */
    public function make_drinks_test(UserRequest $userRequest, string $expectedCommand)
    {
        $this->assertEquals($expectedCommand, $this->machineDriver->process($userRequest));
    }

    private function make_drinks(): array
    {
        return [
            'Drink maker makes 1 tea with 1 sugar and a stick' => [(new UserRequestBuilder())->tea()->withSugar()->build(), "T:1:0"],
            'Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [(new UserRequestBuilder())->chocolate()->withoutSugar()->build(), "H::"],
            'Drink maker makes 1 coffee with 2 sugars and a stick' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->build(), "H::"],
        ];
    }

}
