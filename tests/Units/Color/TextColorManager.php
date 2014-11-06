<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class TextColorManager extends atoum
{
    public function testGenericCall()
    {
        $testString = 'Colored';

        $result = Color\TextColorManager::green(array($testString));

        $this
            ->string($result)
            ->isEqualTo("\033[32mColored\033[0m");
    }

    public function testColor()
    {
        $result = Color\TextColorManager::color(32);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Color\TextColor')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[32m");

        $result = Color\TextColorManager::color(34);

        $this
            ->object($result)
            ->isInstanceOf('\Matks\Vivian\Color\TextColor')
            ->string($result->getEscapeCharacter())
            ->isEqualTo("\033[34m");
    }

    public function testUnknownColor()
    {
        $this
            ->exception(
                function () {
                    Color\TextColorManager::color(3);
                }
            )->hasMessage('Unknown color ID 3');
    }
}
