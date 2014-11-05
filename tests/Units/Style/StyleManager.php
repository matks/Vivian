<?php

namespace Matks\Vivian\tests\Units\Style;

use Matks\Vivian\Style as BaseStyle;

use \atoum;

class StyleManager extends atoum
{
    public function testGenericCall()
    {
        $testString = 'Bold';

        $this
            ->string(BaseStyle\StyleManager::bold(array($testString)))
            ->isEqualTo("\033[1mBold\033[0m");
    }

    public function testStyle()
    {
        $testString = 'foo';

        $this
            ->string(BaseStyle\StyleManager::style($testString, 1))
            ->isEqualTo("\033[1mfoo\033[0m");

        $testString2 = 'a different string';

        $this
            ->string(BaseStyle\StyleManager::style($testString2, 4))
            ->isEqualTo("\033[4ma different string\033[0m");
    }

    public function testUnknownStyle()
    {
        $this
            ->exception(
                function () {
                    BaseStyle\StyleManager::style('foo', 10);
                }
            )->hasMessage('Unknown style ID 10');
    }

    public function testDoubleBackgroundStyle()
    {
        $testString = 'foo';
        $style1     = BaseStyle\StyleManager::style($testString, 1);
        $style2     = BaseStyle\StyleManager::style($style1, 5);

        $this
            ->string($style2)
            ->isEqualTo("\033[5m\033[1mfoo\033[0m\033[0m");
    }
}
