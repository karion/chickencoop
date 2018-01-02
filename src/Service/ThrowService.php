<?php

namespace Karion\Chickencoop\Service;


use Karion\Chickencoop\Chickencoop;

class ThrowService
{

    /**
     * @var DiceService
     */
    private $diceService;

    public function __construct(DiceService $diceService)
    {
        $this->diceService = $diceService;
    }

    public function makeThrow(Chickencoop $chickencoop)
    {
        $throws = [
            0 => $this->diceService->k6(),
            1 => $this->diceService->k6()
        ];

        if ($throws[0] === $throws[1]) {
            $this->doubleEvent($chickencoop, $throws[0]);
            return true;
        }

        $this->addByThrows($chickencoop, $throws);
        return false;
    }

    private function addByThrows(Chickencoop $chickencoop, array $throws)
    {
        foreach ($throws as $throw) {
            switch ($throw) {
                case 1:
                case 2:
                case 3:
                    $chickencoop->addEgg();
                    break;
                case 4:
                case 5:
                    $chickencoop->addChicken();
                    break;
                case 6:
                    $chickencoop->addHen();
                    break;
                default:
                    throw new Exception("Dice return value other then 1-6: ". $throw);
                    break;
            }
        }
    }

    private function doubleEvent(Chickencoop $chickencoop, int $throw)
    {
        switch ($throw) {
            case 1:
                $chickencoop->takeEggs(1);
                break;
            case 2:
                $chickencoop->takeChickens(1);
                break;
            case 3:
                $chickencoop->takeHens(1);
                break;
            case 4:
                // give all eggs
                $chickencoop->takeEggs($chickencoop->countEggs());
                break;
            case 5:
                $this->henFluChappened($chickencoop);
                break;
            case 6:
                $this->foxRaid($chickencoop);
                break;
            default:
                throw new Exception("Dice return value other then 1-6: ". $throw);
                break;
        }
    }

    private function henFluChappened(Chickencoop $chickencoop)
    {
        switch ($this->diceService->k6()) {
            case 1:
            case 2:
            case 3:
                // quarantine (lose turn)
                break;
            case 4:
            case 5:
                // lose all chickens
                $chickencoop->takeChickens($chickencoop->countChickens());
                break;
            case 6:
                $chickencoop->takeHens($chickencoop->countHens());
                break;
            default:
                throw new Exception("Dice return value other then 1-6: ". $throw);
                break;
        }
    }

    private function foxRaid(Chickencoop $chickencoop)
    {
        if ($chickencoop->hasRooster() ) {
            // rooster alarm about comming fox
            return;
        }

        $prey = $this->diceService->k6();

        $hensLeft = $chickencoop->takeHens($prey);

        if ($hensLeft >= 0) {
            return;
        }

        $chickensLeft = $chickencoop->takeChickens(abs($hensLeft));

        if ($chickensLeft >= 0) {
            return;
        }
        $chickencoop->takeEggs(abs($chickensLeft));
    }
}