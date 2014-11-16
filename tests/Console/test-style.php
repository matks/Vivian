#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

$bold = Tools::bold('Bold');

echo $bold;
echo PHP_EOL;
echo Tools::blink('Blinking !!!');
echo PHP_EOL;
echo Tools::underline('Underlined');
echo PHP_EOL;
echo Tools::invisible('Invisible');
echo PHP_EOL;