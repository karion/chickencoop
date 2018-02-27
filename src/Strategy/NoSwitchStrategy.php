<?php

namespace Karion\Chickencoop\Strategy;

use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class NoSwitchStrategy implements StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @param Game $game
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