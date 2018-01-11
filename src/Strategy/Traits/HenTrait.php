<?php

namespace Karion\Chickencoop\Strategy\Traits;

trait HenTrait
{
    protected function trySwitchToHen(\Karion\Chickencoop\Chickencoop $chickencoop)
    {
        if ($chickencoop->countChickens() >= 3) {
            $chickencoop->switchToHen();
            return true;
        }

        return false;
    }

}