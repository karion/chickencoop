<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class HenOnlySwitchStrategy implements StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @param Game $game
     */
    public function playRound(Chickencoop $chickencoop, Game $game)
    {
        if($chickencoop->countChickens() >= 3) {
            $game->switchToHen($chickencoop);
            return;
        }

        $game->doThrow($chickencoop);
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