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
        $result = Color\BackgroundColorManager::color(42);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Color\BackgroundColor')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[42m");

        $result = Color\BackgroundColorManager::color(44);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Color\BackgroundColor')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[44m");
    }

    public function testUnknownBackgroundColor()
    {
        $this
            ->exception(
                function () {
                    Color\BackgroundColorManager::color(6);
                }
            )->hasMessage('Unknown color ID 6');
    }
}
