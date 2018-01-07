<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;

class NoSwitchExceptRoosterStrategy implements StrategyInterface
{

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if($chickencoop->hasRooster()) {
            return false;
        }

        if ($chickencoop->countHens() >= 3) {
            $chickencoop->switchToRooster();
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