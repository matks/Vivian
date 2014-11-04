<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class BackgroundColorManager extends atoum
{
    public function testGenericCall()
    {
        $testString = 'Colored';

        $this
            ->string(Color\BackgroundColorManager::back_green(array($testString)))
            ->isEqualTo("\033[42mColored\033[0m");
    }

    public function testBackgroundColor()
    {
        $testString = 'foo';

        $this
            ->string(Color\BackgroundColorManager::color($testString, 42))
            ->isEqualTo("\033[42mfoo\033[0m");

        $testString2 = 'a different string';

        $this
            ->string(Color\BackgroundColorManager::color($testString2, 44))
            ->isEqualTo("\033[44ma different string\033[0m");
    }

    public function testUnknownBackgroundColor()
    {
        $this
            ->exception(
                function () {
                    Color\BackgroundColorManager::color('foo', 6);
                }
            )->hasMessage('Unknown color ID 6');
    }

    public function testDoubleBackgroundColor()
    {
        $this
            ->exception(
                function () {
                    Color\BackgroundColorManager::color("\033[42mfoo\033[0m", 43);
                }
            )->hasMessage('Given string already contains a color escape code');
    }
}
