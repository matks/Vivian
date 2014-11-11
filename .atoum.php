<?php

use \mageekguy\atoum;

$script->addDefaultReport();

$cloverWriter = new atoum\writers\file('./build/logs/clover.xml');
$cloverReport = new atoum\reports\asynchronous\clover();
$cloverReport->addWriter($cloverWriter);

$runner->addReport($cloverReport);

?>