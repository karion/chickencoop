<?php

namespace Karion\Chickencoop\Command;

use Karion\Chickencoop\Chickencoop;
use Karion\Chickencoop\Game;
use Karion\Chickencoop\Service\DiceService;
use Karion\Chickencoop\Service\ThrowService;
use Karion\Chickencoop\Strategy\HenAndRoosterSwitchStrategy;
use Karion\Chickencoop\Strategy\HenOnlySwitchStrategy;
use Karion\Chickencoop\Strategy\LastChickenFromEggsSwitchStrategy;
use Karion\Chickencoop\Strategy\LastChickenFromEggsWithRoosterSwitchStrategy;
use Karion\Chickencoop\Strategy\NoSwitchExceptRoosterStrategy;
use Karion\Chickencoop\Strategy\NoSwitchStrategy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class MonteCarlo extends Command
{
    private $strategies;

    protected function configure()
    {
        $this
            ->setName('karion:chickencoop')
            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument(
                        'strategy',
                        InputArgument::OPTIONAL
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
        $this->strategies = [
            new NoSwitchStrategy(),
            new NoSwitchExceptRoosterStrategy(),
            new LastChickenFromEggsSwitchStrategy(),
            new LastChickenFromEggsWithRoosterSwitchStrategy(),
            new HenOnlySwitchStrategy(),
            new HenAndRoosterSwitchStrategy()
        ];
        
        
        $gamesLimit = (int) $input->getArgument('games');
        $gamesCount = 0;

        $gameEngine = new Game(
            new ThrowService(new DiceService()),
            $this->strategies
        );
        
        $gameStrategy = $this->findGameStrategy($input, $output);

        while ($gamesCount <= $gamesLimit) {
            $chickencoop = new Chickencoop();

            $stats = $gameEngine->play($chickencoop, $gameStrategy);

            $output->writeln($stats);

            $gamesCount++;
            unset($chickencoop);
        }
    }

    private function findGameStrategy(InputInterface $input, OutputInterface $output)
    {
        $strategy = $input->getArgument('strategy');

        if ($strategy === null) {
            /** @var QuestionHelper $questionHelper */
            $questionHelper = $this->getHelper('question');

            $question = new ChoiceQuestion(
                'Please select strategy: ',
                array_map(function($s){return $s->getName();},$this->strategies)
            );

            $strategy = $questionHelper->ask($input, $output, $question);
        }

        return $strategy;
    }

}