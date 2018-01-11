<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Strategy\Traits\HenTrait;

class HenOnlySwitchStrategy implements StrategyInterface
{
    use HenTrait;

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop): bool
    {
        if ($this->trySwitchToHen($chickencoop)) {
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
        return "hen_only_switch";
    }
}