#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;

echo 'Look how pretty this is:' . PHP_EOL;
echo Matks\Vivian\Tools::red('W');
echo Matks\Vivian\Tools::green('o');
echo Matks\Vivian\Tools::yellow('n');
echo Matks\Vivian\Tools::blue('d');
echo Matks\Vivian\Tools::black('e');
echo Matks\Vivian\Tools::purple('r');
echo Matks\Vivian\Tools::cyan('f');
echo Matks\Vivian\Tools::white('u');
echo 'l !!!' . PHP_EOL;