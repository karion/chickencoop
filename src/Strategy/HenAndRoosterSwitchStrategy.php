<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class HenAndRoosterSwitchStrategy implements StrategyInterface
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

        if ($chickencoop->countChickens() >= 3) {
            $game->switchToHen();
            return;
        }

        $game->doThrow();
    }

    /**
     * get strategy name
     * @return string
     */
    public function getName(): string
    {
        return "hen_and_rooster_switch";
    }
}