<?php

namespace Matks\Vivian\tests\Units;

use Matks\Vivian;

use \atoum;

class Tools extends atoum
{
    public function testColors()
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

    public function testUnknownColor()
    {
        $this
            ->exception(
                function () {
                    Vivian\Tools::unknown('ah');
                }
            )->hasMessage('Unknown function name unknown')
        ;
    }

    public function testStyles()
    {
        $testString = 'hello';
        $expectedString1 = 'hello' . PHP_EOL . '-----' . PHP_EOL;
        $expectedString2 = 'hello' . PHP_EOL . '=====' . PHP_EOL;

        $this
            ->string(Vivian\Tools::underline($testString))
                ->isEqualTo($expectedString1)
            ->string(Vivian\Tools::doubleUnderline($testString))
                ->isEqualTo($expectedString2)
        ;

        $testString = 'Not a test';
        $expectedString1 = '+------------+' . PHP_EOL . '| Not a test |' . PHP_EOL . '+------------+' . PHP_EOL;
        $expectedString2 = '*============*' . PHP_EOL . '# Not a test #' . PHP_EOL . '*============*' . PHP_EOL;

        $this
            ->string(Vivian\Tools::border($testString))
                ->isEqualTo($expectedString1)
            ->string(Vivian\Tools::doubleBorder($testString))
                ->isEqualTo($expectedString2)
        ;
    }
}
