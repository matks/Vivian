#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

$array = array(
    'Foo' => 'aaaaaaa',
    Tools::blink('Blinker') => Tools::underline('Underlined'),
    Tools::blue('Blue') => $styled
);

echo Tools::s_phpArray($array);
