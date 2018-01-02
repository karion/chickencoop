#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Karion\Chickencoop\Command\MonteCarlo;
use Symfony\Component\Console\Application;

$application = new Application('MonteCarlo', '1.0.0');
$command = new MonteCarlo();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);
$application->run();