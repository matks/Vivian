#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;

$array = array(
    'Foo' => 'aaaaaaa',
    Matks\Vivian\Tools::blink('Blinker') => Matks\Vivian\Tools::underline('Underlined'),
    Matks\Vivian\Tools::blue('Blue') => $styled
);

echo Matks\Vivian\Tools::s_phpArray($array);
