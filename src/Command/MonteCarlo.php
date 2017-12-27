<?php
/**
 * Created by PhpStorm.
 * User: karion
 * Date: 27.12.17
 * Time: 12:11
 */

namespace Karion\Chickencoop\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MonteCarlo extends Command
{
    protected function configure()
    {
        $this
            ->setName('karion:chickencoop')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        dump("start");
        // ...
    }

}