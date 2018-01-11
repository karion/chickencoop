<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Strategy\Traits\HenTrait;
use Karion\Chickencoop\Strategy\Traits\LastChickenTrait;

class LastChickenFromEggsSwitchStrategy implements StrategyInterface
{
    use HenTrait;
    use LastChickenTrait;

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if ($this->trySwitchToHen($chickencoop)) {
            return true;
        }

        if ($this->trySwitchToLastChicken($chickencoop)){
            return true;
        }

        return false;
    }

    /**
     * get strategy name
     * @return string
     */
    public function getName(): string
    {
        return "last_chicken";
    }
}