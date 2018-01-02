<?php

namespace Karion\Chickencoop\Service;


class DiceService
{
    public function k6() : int
    {
        return rand(1,6);
    }

}