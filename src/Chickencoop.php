<?php

namespace Karion\Chickencoop;


use Karion\Chickencoop\Exception\SwitchException;

class Chickencoop
{
    /**
     * @var bool
     */
    protected $rooster = false;

    /**
     * @var int
     */
    protected $hens = 0;

    /**
     * @var int
     */
    protected $chickens = 0;

    /**
     * @var int
     */
    protected $eggs = 0;


    /**
     * @return bool
     */
    public function isChickencoopFull() : bool
    {
        return $this->hens >= 9;
    }

    /**
     * @return bool
     */
    public function hasRooster() : bool
    {
        return $this->rooster;
    }

    /**
     * @return int
     */
    public function countHens() : int
    {
        return $this->hens;
    }

    /**
     * @return int
     */
    public function countChickens(): int
    {
        return $this->chickens;
    }

    /**
     * @return int
     */
    public function countEggs() : int
    {
        return $this->eggs;
    }

    public function switchToRooster()
    {
        if ($this->rooster) {
            throw new SwitchException("Rooster already in chickencoop");
        }

        if ($this->hens < 3) {
            throw new SwitchException("Not enough hens to switch");
        }

        $this->hens -= 3;
        $this->rooster = true;
    }

    public function switchToHen()
    {
        if ($this->chickens < 3) {
            throw new SwitchException("Not enough chickens to switch");
        }

        $this->chickens -= 3;
        $this->hens++;
    }

    public function switchToChicken()
    {
        if ($this->eggs < 3) {
            throw new SwitchException("Not enough eggs to switch");
        }

        $this->eggs -= 3;
        $this->chickens++;
    }

    /**
     * Reduce number of hens.
     * If quantity of hens is to small negative number will be returned (but hens count will be 0)
     *
     * @param int $quantity
     * @return int
     */
    public function takeHens(int $quantity) : int
    {
        $this->hens -= $quantity;

        if ($this->hens >= 0) {
            return $this->hens;
        }

        $missing = $this->hens;
        $this->hens = 0;
        return $missing;
    }

    public function takeChickens(int $quantity) : int
    {
        $this->chickens -= $quantity;

        if ($this->chickens >= 0) {
            return $this->chickens;
        }

        $missing = $this->chickens;
        $this->chickens = 0;
        return $missing;
    }

    public function takeEggs(int $quantity) : int
    {
        $this->eggs -= $quantity;

        if ($this->eggs >= 0) {
            return $this->eggs;
        }

        $missing = $this->eggs;
        $this->eggs = 0;
        return $missing;
    }
}