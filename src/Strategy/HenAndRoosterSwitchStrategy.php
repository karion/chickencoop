<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Strategy\Traits\HenTrait;
use Karion\Chickencoop\Strategy\Traits\RoosterTrait;

class HenAndRoosterSwitchStrategy implements StrategyInterface
{
    use RoosterTrait;
    use HenTrait;

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if ($this->trySwitchToRooster($chickencoop)) {
            return true;
        }

        if ($this->trySwitchToHen($chickencoop)){
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
        return "hen_and_rooster_switch";
    }
}