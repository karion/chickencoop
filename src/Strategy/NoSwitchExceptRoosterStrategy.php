<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Strategy\Traits\RoosterTrait;

class NoSwitchExceptRoosterStrategy implements StrategyInterface
{
    use RoosterTrait;

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if ($this->trySwitchToRooster()) {
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
        return "no_switch_except_rooster";
    }
}