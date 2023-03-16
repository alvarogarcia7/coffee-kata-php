<?php

namespace Tests\Kata;

use Kata\UserRequest;

class UserRequestBuilder
{

    private string $drink;
    private int $sugar = 0;
    private string $message;

    public function __construct()
    {
    }

    public function build(): UserRequest
    {
        return new UserRequest($this->drink, $this->sugar);
    }

    public function tea(): self
    {
        $this->drink = "tea";
        return $this;
    }

    public function chocolate()
    {
        $this->drink = "chocolate";
        return $this;
    }

    public function coffee()
    {
        $this->drink = "coffee";
        return $this;
    }

    public function message(string $value)
    {
        $this->drink = "message";
        return $this;
    }

    public function sugar(int $value): self
    {
        $this->sugar = $value;
        return $this;
    }

    public function money(float $value): self
    {
        return $this;
    }
}