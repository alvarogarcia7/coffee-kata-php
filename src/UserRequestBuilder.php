<?php
declare(strict_types=1);


namespace Kata;

class UserRequestBuilder
{

    private int $sugar;
    private string $drink;
    private string $message = "";
    private float $money = 0.0;

    public function __construct()
    {
    }

    public function tea(): self
    {
        $this->drink = "tea";
        return $this;
    }

    public function withSugar(): self
    {
        return $this;
    }

    public function chocolate(): self
    {
        $this->drink = "chocolate";
        return $this;
    }

    public function build(): UserRequest
    {
        $return = new UserRequest();
        $return->drink = $this->drink;
        $return->message = $this->message;
        $return->availableMoney = $this->money;
        return $return;
    }

    public function withoutSugar(): self
    {
        $this->sugar = 0;
        return $this;
    }

    public function coffee(): self
    {
        $this->drink = "coffee";
        return $this;
    }

    public function printMessage(string $message): self
    {
        $this->drink = "message";
        $this->message = $message;
        return $this;
    }

    public function withMoney(float $insertedMoney): self
    {
        $this->money = $insertedMoney;
        return $this;
    }

    public function orangeJuice(): self
    {
        return $this;
    }
}