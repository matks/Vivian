#!/usr/bin/env php
<?php

$autoloadFile = __DIR__.'/../../vendor/autoload.php';

require $autoloadFile;
use Matks\Vivian\Tools;

$list = array('a', 'b', 'c');
$array = array('a' => 'hello', 'second' => 3, 'over' => 'stronger');

echo Tools::s_list1($list);
echo Tools::s_list2($list);
echo PHP_EOL;
echo Tools::s_phpArray($array);
echo Tools::s_array($array);