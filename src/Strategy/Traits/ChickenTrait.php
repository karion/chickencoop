<?php

namespace Karion\Chickencoop\Strategy\Traits;

trait ChickenTrait
{
    protected function trySwitchToChicken(\Karion\Chickencoop\Chickencoop $chickencoop)
    {
        if ($chickencoop->countEggs() >= 3) {
            $chickencoop->switchToChicken();
            return true;
        }

        return false;
    }

}