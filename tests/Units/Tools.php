<?php

namespace Matks\Vivian\tests\Units;

use Matks\Vivian;

use \atoum;

class Tools extends atoum
{
    public function testConstruct()
    {
        $testString = 'hello';

        $this
            ->string(Vivian\Tools::green($testString))
                ->isEqualTo("\033[32mhello\033[0m")
        ;

        $testString2 = 'this is [a test]';

        $this
            ->string(Vivian\Tools::blue($testString2))
                ->isEqualTo("\033[34mthis is [a test]\033[0m")
        ;
    }
}
