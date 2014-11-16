#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

echo 'Look how pretty this is:' . PHP_EOL;
echo Tools::back_red('W');
echo Tools::back_green('o');
echo Tools::back_yellow('n');
echo Tools::back_blue('d');
echo Tools::back_black('e');
echo Tools::back_purple('r');
echo Tools::back_cyan('f');
echo Tools::back_white('u');
echo 'l !!!' . PHP_EOL;