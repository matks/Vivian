#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

echo 'Look how pretty this is:' . PHP_EOL;
echo Tools::red('W');
echo Tools::green('o');
echo Tools::yellow('n');
echo Tools::blue('d');
echo Tools::black('e');
echo Tools::purple('r');
echo Tools::cyan('f');
echo Tools::white('u');
echo 'l !!!' . PHP_EOL;