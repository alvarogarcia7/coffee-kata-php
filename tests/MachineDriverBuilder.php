<?php

namespace Tests\Kata;


use Kata\BeverageQuantityChecker;
use Kata\DrinkFactory;
use Kata\DrinkLog;
use Kata\EmailNotifier;
use Kata\MachineDriver;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

class MachineDriverBuilder {

    private Prophet $prophet;

    private ObjectProphecy|DrinkLog $drinkLog;
    private ObjectProphecy|DrinkFactory $drinkFactory;
    private ObjectProphecy|BeverageQuantityChecker $beverageQuantityChecker;
    private ObjectProphecy|EmailNotifier $emailNotifier;

    public function __construct()
    {
        $this->prophet = new Prophet();
        $this->emailNotifier = $this->prophet->prophesize(EmailNotifier::class);
        $this->beverageQuantityChecker = $this->prophet->prophesize(BeverageQuantityChecker::class);
        $this->drinkLog = new DrinkLog();
        $this->drinkFactory = new DrinkFactory();
    }

    public static function aNew()
    {
        return new MachineDriverBuilder();
    }

    public function drinkLog(ObjectProphecy|DrinkLog $drinkLog): self
    {
        $this->drinkLog = $drinkLog;
        return $this;
    }
    public function drinkFactory(ObjectProphecy|DrinkFactory $drinkFactory): self
    {
        $this->drinkFactory = $drinkFactory;
        return $this;
    }

    public function build()
    {
        $drinkFactory = $this->drinkFactory;
        if (get_class($this->drinkFactory) === ObjectProphecy::class) {
            $drinkFactory = $this->drinkFactory->reveal();
        }

        $drinkLog = $this->drinkLog;
        if (get_class($this->drinkLog) === ObjectProphecy::class) {
            $drinkLog = $this->drinkLog->reveal();
        }
        return new MachineDriver($drinkFactory, $drinkLog, $this->beverageQuantityChecker->reveal(), $this->emailNotifier->reveal());
    }

    public function getBeverageQuantityChecker(): BeverageQuantityChecker|ObjectProphecy
    {
        return $this->beverageQuantityChecker;
    }

    public function getEmailNotifier(): ObjectProphecy|EmailNotifier
    {
        return $this->emailNotifier;
    }
}