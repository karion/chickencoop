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

    /**
     * @var \Karion\Chickencoop\Service\ThrowService
     */
    private $throwService;


    public function __construct(\Karion\Chickencoop\Service\ThrowService $throwService, array $strategies)
    {
        foreach ($strategies as $strategy) {
            if (!$strategy instanceof \Karion\Chickencoop\Strategy\StrategyInterface) {
                throw new Exception("Can't register this as strategy");
            }

            $this->strategies[$strategy->getName()] = $strategy;
        }
        $this->throwService = $throwService;
    }

    public function play(\Karion\Chickencoop\Chickencoop $chickencoop, $strategyName)
    {
        if (!array_key_exists($strategyName, $this->strategies)) {
            throw new Exception('Unknown strategy.');
        }

        $this->strategy = $this->strategies[$strategyName];

        $this->setupGame();

        do {

            if (! $this->strategy->makeSwitch($chickencoop)) {
                $this->doThrow($chickencoop);
            }

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
    }

    private function gameStats(\Karion\Chickencoop\Chickencoop $chickencoop, $strategyName)
    {
        $stats = [
            $strategyName,
            $this->turns,
            $chickencoop->hasRooster()? "true" : "false",
            $chickencoop->countHens() ,
            $chickencoop->countChickens(),
            $chickencoop->countEggs(),
            $this->doublesCount
        ];

        return implode(', ', $stats);
    }

    private function doThrow(\Karion\Chickencoop\Chickencoop $chickencoop)
    {
        if ($this->throwService->makeThrow($chickencoop)) {
            $this->doublesCount++;
        }
    }
}