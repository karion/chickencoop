<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Strategy\Traits\HenTrait;
use Karion\Chickencoop\Strategy\Traits\LastChickenTrait;
use Karion\Chickencoop\Strategy\Traits\RoosterTrait;

class LastChickenFromEggsWithRoosterSwitchStrategy implements StrategyInterface
{
    use RoosterTrait;
    use HenTrait;
    use LastChickenTrait;

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if ($this->trySwitchToRooster($chickencoop)) {
            return true;
        }

        if ($this->trySwitchToHen($chickencoop)) {
            return true;
        }

        if ($this->trySwitchToLastChicken($chickencoop)) {
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
        return "last_chicken_with_rooster";
    }
}