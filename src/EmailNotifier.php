<?php

namespace Kata;

interface EmailNotifier
{
    public function notifyMissingDrink(string $drink);
}