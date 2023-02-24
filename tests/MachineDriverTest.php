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

    /** @test  @dataProvider process_user_requests_ */
    public function process_user_requests(UserRequest $userRequest, string $expectedCommand)
    {
        $this->assertEquals($expectedCommand, $this->machineDriver->process($userRequest));
    }

    private function process_user_requests_(): array
    {
        return [
            'Drink maker makes 1 tea with 1 sugar and a stick' => [(new UserRequestBuilder())->tea()->withSugar()->build(), "T:1:0"],
            'Drink maker makes 1 chocolate with no sugar - and therefore no stick' => [(new UserRequestBuilder())->chocolate()->withoutSugar()->build(), "H::"],
            'Drink maker makes 1 coffee with 2 sugars and a stick' => [(new UserRequestBuilder())->coffee()->withSugar()->withSugar()->build(), "C:2:0"],
            'Drink maker forwards any message received onto the coffee machine interface for the customer to see' => [(new UserRequestBuilder())->printMessage("message-content")->build(), "M:message-content"],
        ];
    }

}
