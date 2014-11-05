<?php

namespace Matks\Vivian\tests\Units\Style;

use Matks\Vivian\Style;

use \atoum;

class StyleManager extends atoum
{
    public function testGenericCall()
    {
        $testString = 'Bold';

        $this
            ->string(Style\StyleManager::bold(array($testString)))
            ->isEqualTo("\033[1mBold\033[0m");
    }

    public function testStyle()
    {
        $testString = 'foo';

        $this
            ->string(Style\StyleManager::style($testString, 1))
            ->isEqualTo("\033[1mfoo\033[0m");

        $testString2 = 'a different string';

        $this
            ->string(Style\StyleManager::style($testString2, 4))
            ->isEqualTo("\033[4ma different string\033[0m");
    }

    public function testUnknownStyle()
    {
        $this
            ->exception(
                function () {
                    Style\StyleManager::style('foo', 10);
                }
            )->hasMessage('Unknown style ID 10');
    }

    public function testDoubleBackgroundStyle()
    {
        $testString = 'foo';
        $style1     = Style\StyleManager::style($testString, 1);
        $style2     = Style\StyleManager::style($style1, 5);

        $this
            ->string($style2)
            ->isEqualTo("\033[5m\033[1mfoo\033[0m\033[0m");
    }
}
