<?php

namespace Matks\Vivian\tests\Units\Structure;

use Matks\Vivian\Structure;

use \atoum;

class StructureManager extends atoum
{
    public function testGenericCall()
    {
        $array = array(
            'a',
            'bb',
            'ccc'
        );

        $expectedArray = '# a' . PHP_EOL;
        $expectedArray .= '# bb' . PHP_EOL;
        $expectedArray .= '# ccc' . PHP_EOL;

        $this
            ->string(Structure\StructureManager::s_list1(array($array)))
            ->isEqualTo($expectedArray);
    }

    public function testList1()
    {
        $array = array(
            'a',
            'bb',
            'ccc'
        );

        $expectedArray = '# a' . PHP_EOL;
        $expectedArray .= '# bb' . PHP_EOL;
        $expectedArray .= '# ccc' . PHP_EOL;

        $this
            ->string(Structure\StructureManager::__s_list1($array))
            ->isEqualTo($expectedArray);
    }

    public function testList2()
    {
        $array = array(
            'a',
            'bb',
            'ccc'
        );

        $expectedArray = '    - a' . PHP_EOL;
        $expectedArray .= '    - bb' . PHP_EOL;
        $expectedArray .= '    - ccc' . PHP_EOL;

        $this
            ->string(Structure\StructureManager::__s_list2($array))
            ->isEqualTo($expectedArray);
    }

    public function testArray()
    {
        $array = array(
            'a'   => 'hello',
            'bb'  => '1',
            'ccc' => 'done'
        );

        $expectedArray = '+-----+-------+' . PHP_EOL;
        $expectedArray .= '| a   | hello |' . PHP_EOL;
        $expectedArray .= '| bb  | 1     |' . PHP_EOL;
        $expectedArray .= '| ccc | done  |' . PHP_EOL;
        $expectedArray .= '+-----+-------+' . PHP_EOL;

        $this
            ->string(Structure\StructureManager::__s_array($array))
            ->isEqualTo($expectedArray);
    }

    public function testPhpArray()
    {
        $array = array(
            'a'   => 'hello',
            'bb'  => '1',
            'ccc' => 'done'
        );

        $expectedArray = '    a   => hello' . PHP_EOL;
        $expectedArray .= '    bb  => 1' . PHP_EOL;
        $expectedArray .= '    ccc => done' . PHP_EOL;

        $this
            ->string(Structure\StructureManager::__s_phpArray($array))
            ->isEqualTo($expectedArray);
    }

    public function testUnknownStructure()
    {
        $this
            ->exception(
                function () {
                    Structure\StructureManager::unknown('foo');
                }
            )->hasMessage('Unknown structure function name unknown');
    }
}
