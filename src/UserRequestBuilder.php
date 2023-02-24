<?php
declare(strict_types=1);


namespace Kata;

class UserRequestBuilder
{

    public function __construct()
    {
    }

    public function tea(): self
    {
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
        return new UserRequest();
    }

    public function withoutSugar(): self
    {
        $this->sugar = 0;
        return $this;
    }
}