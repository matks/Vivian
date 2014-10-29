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
            ->isEqualTo("\033[32mhello\033[0m");

        $testString2 = 'this is [a test]';

        $this
            ->string(Vivian\Tools::blue($testString2))
            ->isEqualTo("\033[34mthis is [a test]\033[0m");
    }

    public function testUnknownFunction()
    {
        $this
            ->exception(
                function () {
                    Vivian\Tools::unknown('ah');
                }
            )->hasMessage('Unknown function name unknown');
    }

    public function testBorders()
    {
        $testString      = 'hello';
        $expectedString1 = 'hello' . PHP_EOL . '-----' . PHP_EOL;
        $expectedString2 = 'hello' . PHP_EOL . '=====' . PHP_EOL;

        $this
            ->string(Vivian\Tools::underlineBorder($testString))
            ->isEqualTo($expectedString1)
            ->string(Vivian\Tools::doubleUnderlineBorder($testString))
            ->isEqualTo($expectedString2);

        $testString      = 'Not a test';
        $expectedString1 = '+------------+' . PHP_EOL . '| Not a test |' . PHP_EOL . '+------------+' . PHP_EOL;
        $expectedString2 = '*============*' . PHP_EOL . '# Not a test #' . PHP_EOL . '*============*' . PHP_EOL;

        $this
            ->string(Vivian\Tools::border($testString))
            ->isEqualTo($expectedString1)
            ->string(Vivian\Tools::doubleBorder($testString))
            ->isEqualTo($expectedString2);
    }

    public function testStructures()
    {
        $testList  = array(
            'hello',
            5,
            'foo'
        );
        $testArray = array(
            'a'     => 'b',
            'never' => 'over',
            'loop'  => 'infinite'
        );

        $expectedList1 = '# hello' . PHP_EOL . '# 5' . PHP_EOL . '# foo' . PHP_EOL;
        $expectedList2 = '    - hello' . PHP_EOL . '    - 5' . PHP_EOL . '    - foo' . PHP_EOL;

        $this
            ->string(Vivian\Tools::s_list1($testList))
            ->isEqualTo($expectedList1)
            ->string(Vivian\Tools::s_list2($testList))
            ->isEqualTo($expectedList2);

        $expectedArray1 = '    a     => b' . PHP_EOL . '    never => over' . PHP_EOL . '    loop  => infinite' . PHP_EOL;
        $expectedArray2 = '+-------+----------+' . PHP_EOL;
        $expectedArray2 .= '| a     | b        |' . PHP_EOL;
        $expectedArray2 .= '| never | over     |' . PHP_EOL;
        $expectedArray2 .= '| loop  | infinite |' . PHP_EOL;
        $expectedArray2 .= '+-------+----------+' . PHP_EOL;

        $this
            ->string(Vivian\Tools::s_phpArray($testArray))
            ->isEqualTo($expectedArray1)
            ->string(Vivian\Tools::s_array($testArray))
            ->isEqualTo($expectedArray2);
    }

    public function testStyles()
    {
        $testString = 'hello';

        $this
            ->string(Vivian\Tools::bold($testString))
            ->isEqualTo("\033[1mhello\033[0m");

        $testString2 = 'this is [a test]';

        $this
            ->string(Vivian\Tools::blink($testString2))
            ->isEqualTo("\033[5mthis is [a test]\033[0m");
    }

    public function testMix()
    {
        $testString     = 'Now this is wonderful:';
        $expectedString = "\033[36mNow this is wonderful:" . PHP_EOL . "======================" . PHP_EOL . "\033[0m";

        $style        = Vivian\Tools::doubleUnderlineBorder($testString);
        $coloredStyle = Vivian\Tools::cyan($style);

        $this
            ->string($coloredStyle)
            ->isEqualTo($expectedString);
    }
}
