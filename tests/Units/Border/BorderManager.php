<?php

namespace Matks\Vivian\tests\Units\Border;

use Matks\Vivian\Border as BaseBorder;

use \atoum;
use Mock;

class BorderManager extends atoum
{
    public function testGenericCall()
    {
        $testString     = 'Hello';
        $expectedString = 'Hello' . PHP_EOL . '-----' . PHP_EOL;

        $this
            ->string(BaseBorder\BorderManager::underlineBorder(array($testString)))
            ->isEqualTo($expectedString);
    }

    public function testUnderlineBorder()
    {
        $testString     = 'foo';
        $expectedString = 'foo' . PHP_EOL . '---' . PHP_EOL;

        $border = new Mock\Matks\Vivian\Border\Border('underline');

        $this
            ->string(BaseBorder\BorderManager::buildBorder($testString, $border))
            ->isEqualTo($expectedString);
    }

    public function testDoubleUnderlineBorder()
    {
        $testString     = 'foo';
        $expectedString = 'foo' . PHP_EOL . '===' . PHP_EOL;

        $border = new Mock\Matks\Vivian\Border\Border('underline', '=');

        $this
            ->string(BaseBorder\BorderManager::buildBorder($testString, $border))
            ->isEqualTo($expectedString);
    }

    public function testBorder()
    {
        $testString     = 'foo';
        $expectedString = '+-----+' . PHP_EOL;
        $expectedString .= '| foo |' . PHP_EOL;
        $expectedString .= '+-----+' . PHP_EOL;

        $border = new Mock\Matks\Vivian\Border\Border('frame');

        $this
            ->string(BaseBorder\BorderManager::buildBorder($testString, $border))
            ->isEqualTo($expectedString);
    }

    public function testDoubleBorder()
    {
        $testString     = 'foo';
        $expectedString = '*=====*' . PHP_EOL;
        $expectedString .= '# foo #' . PHP_EOL;
        $expectedString .= '*=====*' . PHP_EOL;

        $border = new Mock\Matks\Vivian\Border\Border('frame', '=', '#', '*');

        $this
            ->string(BaseBorder\BorderManager::buildBorder($testString, $border))
            ->isEqualTo($expectedString);
    }

    public function testUnknownBorder()
    {
        $this
            ->exception(
                function () {
                    BaseBorder\BorderManager::unknown('foo');
                }
            )->hasMessage('Unknown border function name unknown');
    }
}
