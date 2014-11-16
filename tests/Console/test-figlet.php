#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

echo Tools::figlet_ivrit('Ivrit');
echo Tools::figlet_slant('Slant');
echo Tools::figlet_shadow('Standard');
echo Tools::figlet_script('Script');
echo Tools::figlet_digital('Digital');
echo PHP_EOL;