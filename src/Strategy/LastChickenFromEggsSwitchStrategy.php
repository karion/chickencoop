<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

class LastChickenFromEggsSwitchStrategy implements StrategyInterface
{

    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function playRound(Chickencoop $chickencoop, Game $game): bool
    {
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
        return "last_chicken";
    }
}