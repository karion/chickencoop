<?php

namespace Karion\Chickencoop\Command;

use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;
use Karion\Chickencoop\Service\DiceService;
use Karion\Chickencoop\Service\ThrowService;
use Karion\Chickencoop\Strategy\NoSwitchExceptRoosterStrategy;
use Karion\Chickencoop\Strategy\NoSwitchStrategy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MonteCarlo extends Command
{
    protected function configure()
    {
        $this
            ->setName('karion:chickencoop')
            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument(
                        'strategy',
                        InputArgument::REQUIRED
                    ),
                    new InputArgument(
                        'games',
                        InputArgument::OPTIONAL,
                        "",
                        1000
                    )
                ))
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameStrategy = $input->getArgument('strategy');
        $gamesLimit = (int) $input->getArgument('games');
        $gamesCount = 0;

        $gameEngine = new Game(
            new ThrowService(new DiceService()),
            [
                new NoSwitchStrategy(),
                new NoSwitchExceptRoosterStrategy()
            ]
        );

        while ($gamesCount <= $gamesLimit) {
            $chickencoop = new Chickencoop();

            $stats = $gameEngine->play($chickencoop, $gameStrategy);

            $output->writeln($stats);

            $gamesCount++;
            unset($chickencoop);
        }
    }

}