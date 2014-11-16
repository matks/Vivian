#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

echo Tools::doubleBorder('Big border');
echo Tools::border('Cool !');
echo Tools::underlineBorder('Great !');
echo Tools::doubleUnderlineBorder('Awesome !');
echo PHP_EOL;