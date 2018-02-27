<?php

namespace Karion\Chickencoop\Strategy;

use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class NoSwitchExceptRoosterStrategy implements StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @param Game $game
     */
    public function playRound(Chickencoop $chickencoop, Game $game)
    {
        if (!$chickencoop->hasRooster()) {
            if ($chickencoop->countHens() >= 3) {
                $game->switchToRooster();
                return;
            }
        }
        $game->doThrow($chickencoop);
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