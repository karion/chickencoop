<?php

namespace Karion\Chickencoop\Strategy\Traits;

trait RoosterTrait
{
    protected function trySwitchRooster(\Karion\Chickencoop\Chickencoop $chickencoop)
    {

        if ($chickencoop->hasRooster()) {
            return false;
        }

        if ($chickencoop->countHens() >= 3) {
            $chickencoop->switchToRooster();
            return true;
        }

        return false;
    }

}