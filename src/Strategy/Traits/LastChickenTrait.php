<?php

namespace Karion\Chickencoop\Strategy\Traits;

trait LastChickenTrait
{
    protected function trySwitchToLastChicken(\Karion\Chickencoop\Chickencoop $chickencoop)
    {
        if ($chickencoop->countChickens() !=2) {
            return false;
        }

        if ($chickencoop->countEggs() >= 3) {
            $chickencoop->switchToChicken();
            return true;
        }

        return false;
    }

}