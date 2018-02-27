<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;

interface StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @param Game $game
     */
    public function playRound(Chickencoop $chickencoop, Game $game);

    /**
     * get strategy name
     * @return string
     */
    public function getName() : string;
}