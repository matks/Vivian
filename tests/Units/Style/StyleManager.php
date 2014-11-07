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
        $result = BaseStyle\StyleManager::style(1);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Style\Style')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[1m");

        $result = BaseStyle\StyleManager::style(5);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Style\Style')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[5m");
    }

    public function testUnknownStyle()
    {
        $this
            ->exception(
                function () {
                    BaseStyle\StyleManager::style(10);
                }
            )->hasMessage('Unknown style ID 10');
    }
}
