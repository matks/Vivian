#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;

echo Matks\Vivian\Tools::doubleBorder('Big border');
echo Matks\Vivian\Tools::border('Cool !');
echo Matks\Vivian\Tools::underlineBorder('Great !');
echo Matks\Vivian\Tools::doubleUnderlineBorder('Awesome !');
echo PHP_EOL;