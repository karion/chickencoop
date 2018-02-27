<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class LastChickenFromEggsWithRoosterSwitchStrategy implements StrategyInterface
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
            $game->switchToHen($chickencoop);
            return;
        }

        if ($chickencoop->countChickens() == 2 && $chickencoop->countEggs() >= 3) {
            $game->switchToChicken($chickencoop);
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
        return "last_chicken_with_rooster";
    }
}