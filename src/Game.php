<?php

namespace Karion\Chickencoop;

class Game
{
    /**
     * @var array
     */
    private $strategies;

    /**
     * @var \Karion\Chickencoop\Strategy\StrategyInterface
     */
    private $strategy;

    private $turns = 0;

    private $doublesCount = 0;

    private $henSwitchs = 0;

    private $chickenSwitch = 0;

    /**
     * @var \Karion\Chickencoop\Service\ThrowService
     */
    private $throwService;


    public function __construct(\Karion\Chickencoop\Service\ThrowService $throwService, array $strategies)
    {
        foreach ($strategies as $strategy) {
            if (!$strategy instanceof \Karion\Chickencoop\Strategy\StrategyInterface) {
                throw new \Exception("Can't register this as strategy");
            }

            $this->strategies[$strategy->getName()] = $strategy;
        }
        $this->throwService = $throwService;
    }

    public function play(Chickencoop $chickencoop, $strategyName)
    {
        if (!array_key_exists($strategyName, $this->strategies)) {
            throw new \Exception('Unknown strategy.');
        }

        $this->strategy = $this->strategies[$strategyName];

        $this->setupGame();

        do {
            $this->strategy->playRound($chickencoop, $this);

            $this->turns++;
        } while (!$chickencoop->isChickencoopFull());

        return $this->gameStats($chickencoop, $strategyName);
    }

    /**
     * This Method setup starting point of game stats.
     */
    private function setupGame()
    {
        $this->turns = 0;
        $this->doublesCount = 0;
        $this->henSwitchs = 0;
        $this->chickenSwitch = 0;
    }

    private function gameStats(Chickencoop $chickencoop, $strategyName)
    {
        $stats = [
            $strategyName,
            $this->turns,
            $chickencoop->hasRooster()? "true" : "false",
            $chickencoop->countHens() ,
            $chickencoop->countChickens(),
            $chickencoop->countEggs(),
            $this->doublesCount,
            $this->chickenSwitch,
            $this->henSwitchs
        ];

        return implode(', ', $stats);
    }

    public function doThrow(Chickencoop $chickencoop)
    {
        if ($this->throwService->makeThrow($chickencoop)) {
            $this->doublesCount++;
        }
    }

    public function getStategies()
    {
        return $this->strategies;
    }

    public function switchToRooster(Chickencoop $chickencoop)
    {
        $chickencoop->switchToRooster();
    }

    public function switchToHen(Chickencoop $chickencoop)
    {
        $chickencoop->switchToHen();
        $this->henSwitchs++;
    }

    public function switchToChicken(Chickencoop $chickencoop)
    {
        $chickencoop->switchToChicken();
        $this->chickenSwitch++;
    }
}