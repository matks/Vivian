<?php

namespace Matks\Vivian\tests\Units;

use Matks\Vivian;

use \atoum;

class Util extends atoum
{
    public function testGetMaxKeyLength()
    {
        $testArray = array(
            'foo'                      => 'hello',
            'maximum'                  => 'not',
            'this is serious business' => 'yeah',
            'a'                        => 'b'
        );

        $testArray2 = array(
            'a'     => 'b',
            'ab'    => 'eeee',
            'aaaaa' => 'hello',
            'rock'  => "n'roll"
        );

        $testArray3 = array(
            'aaaa'               => 'b',
            "\033[32mlol\033[0m" => 'no'
        );

        $this
            ->integer(Vivian\Util::getMaxKeyLength($testArray))
            ->isEqualTo(24)
            ->integer(Vivian\Util::getMaxKeyLength($testArray2))
            ->isEqualTo(5)
            ->integer(Vivian\Util::getMaxKeyLength($testArray3))
            ->isEqualTo(4);
    }

    public function testGetMaxValueLength()
    {
        $testArray = array(
            'foo'                      => 'hello',
            'maximum'                  => 'not',
            'this is serious business' => 'yeah',
            'a'                        => 'b'
        );

        $testArray2 = array(
            'a'     => 'b',
            'ab'    => 'eeee',
            'aaaaa' => 'hello',
            'rock'  => "n'roll"
        );

        $testArray3 = array(
            'aaaa' => 'bbbbbb',
            'no'   => "\033[32mlol\033[0m"
        );

        $this
            ->integer(Vivian\Util::getMaxValueLength($testArray))
            ->isEqualTo(5)
            ->integer(Vivian\Util::getMaxValueLength($testArray2))
            ->isEqualTo(6)
            ->integer(Vivian\Util::getMaxValueLength($testArray3))
            ->isEqualTo(6);
    }

    public function testBuildPatternLine()
    {
        $this
            ->string(Vivian\Util::buildPatternLine('*', 5))
            ->isEqualTo('*****')
            ->string(Vivian\Util::buildPatternLine('#', 10))
            ->isEqualTo('##########')
            ->string(Vivian\Util::buildPatternLine('?!?', 2))
            ->isEqualTo('?!??!?');
    }

    public function testGetVisibleStringLength()
    {
        $testString  = 'hello there !';
        $testString2 = "hello \033[32mthere\033[0m !";
        $testString3 = "\033[32mGreen\033[0m cannot be \033[34mblue\033[0m";

        $this
            ->integer(Vivian\Util::getVisibleStringLength($testString))
            ->isEqualTo(13)
            ->integer(Vivian\Util::getVisibleStringLength($testString2))
            ->isEqualTo(13)
            ->integer(Vivian\Util::getVisibleStringLength($testString3))
            ->isEqualTo(20);
    }
}
