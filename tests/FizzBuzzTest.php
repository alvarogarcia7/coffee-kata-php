<?php

declare(strict_types=1);

namespace Tests\Kata;

use Kata\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    private FizzBuzz $fizzBuzz;

    public function setUp(): void
    {
        parent::setUp();
        $this->machineDriver = new MachineDriver();
    }

    /** @test */
    public function make_tea_with_1_sugar_and_a_stick()
    {
        $request = (new UserRequestBuilder())->tea()->withSugar()->build();

        $this->assertEquals("T:1:0", $this->machineDriver->process($request));
    }
}
