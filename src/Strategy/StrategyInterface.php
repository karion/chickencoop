<?php

namespace Karion\Chickencoop\Strategy;


use Karion\Chickencoop\Chickencoop;

interface StrategyInterface
{
    /**
     * @param Chickencoop $chickencoop
     * @return bool is switch was done on chickencoop
     */
    public function makeSwitch(Chickencoop $chickencoop) :bool;

    /**
     * get strategy name
     * @return string
     */
    public function getName() : string;
}