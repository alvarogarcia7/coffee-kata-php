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
        $this->fizzBuzz = new FizzBuzz();
    }

    /** @test */
    public function make_tea_with_a_sugar_and_a_stick()
    {
        $this->assertEquals("Fizz", $this->fizzBuzz->convert(1));
    }
}
