<?php

namespace Matks\Vivian\tests\Units\Border;

use Matks\Vivian\Border;

use \atoum;

class BorderManager extends atoum
{
    public function testGenericCall()
    {
        $testString     = 'Hello';
        $expectedString = 'Hello' . PHP_EOL . '-----' . PHP_EOL;

        $this
            ->string(Border\BorderManager::underlineBorder(array($testString)))
            ->isEqualTo($expectedString);
    }

    public function testUnderlineBorder()
    {
        $testString     = 'foo';
        $expectedString = 'foo' . PHP_EOL . '---' . PHP_EOL;

        $this
            ->string(Border\BorderManager::__underlineBorder($testString))
            ->isEqualTo($expectedString);
    }

    public function testDoubleUnderlineBorder()
    {
        $testString     = 'foo';
        $expectedString = 'foo' . PHP_EOL . '===' . PHP_EOL;

        $this
            ->string(Border\BorderManager::__doubleUnderlineBorder($testString))
            ->isEqualTo($expectedString);
    }

    public function testBorder()
    {
        $testString     = 'foo';
        $expectedString = '+-----+' . PHP_EOL;
        $expectedString .= '| foo |' . PHP_EOL;
        $expectedString .= '+-----+' . PHP_EOL;

        $this
            ->string(Border\BorderManager::__border($testString))
            ->isEqualTo($expectedString);
    }

    public function testDoubleBorder()
    {
        $testString     = 'foo';
        $expectedString = '*=====*' . PHP_EOL;
        $expectedString .= '# foo #' . PHP_EOL;
        $expectedString .= '*=====*' . PHP_EOL;

        $this
            ->string(Border\BorderManager::__doubleBorder($testString))
            ->isEqualTo($expectedString);
    }

    public function testUnknownBorder()
    {
        $this
            ->exception(
                function () {
                    Border\BorderManager::unknown('foo');
                }
            )->hasMessage('Unknown border function name unknown');
    }
}
