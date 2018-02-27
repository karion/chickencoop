<?php

namespace Karion\Chickencoop\Strategy;

use Karion\Chickencoop\Chickencoop;

class NoSwitchStrategy implements StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function playRound(Chickencoop $chickencoop, Game $game)
    {
        $game->doThrow($chickencoop);
    }

    /**
     * get strategy name
     * @return string
     */
    public function getName(): string
    {
        return "no_switch";
    }
}