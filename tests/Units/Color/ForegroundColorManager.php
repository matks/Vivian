<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class ForegroundColorManager extends atoum
{
    public function testGenericCall()
    {
        $testString = 'Colored';

        $this
            ->string(Color\ForegroundColorManager::green(array($testString)))
            ->isEqualTo("\033[32mColored\033[0m");
    }

    public function testColor()
    {
        $testString = 'foo';

        $this
            ->string(Color\ForegroundColorManager::color($testString, 32))
            ->isEqualTo("\033[32mfoo\033[0m");

        $testString2 = 'another string !=!';

        $this
            ->string(Color\ForegroundColorManager::color($testString2, 34))
            ->isEqualTo("\033[34manother string !=!\033[0m");
    }

    public function testUnknownColor()
    {
        $this
            ->exception(
                function () {
                    Color\ForegroundColorManager::color('foo', 3);
                }
            )->hasMessage('Unknown color ID 3');
    }

    public function testDoubleColor()
    {
        $this
            ->exception(
                function () {
                    Color\ForegroundColorManager::color("\033[32mfoo\033[0m", 33);
                }
            )->hasMessage('Given string already contains a color escape code');
    }
}
