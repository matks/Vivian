<?php

namespace Matks\Vivian\tests\Units\Structure;

use Matks\Vivian\Structure as BaseStructure;

use \atoum;
use Mock;

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
            ->string(BaseStructure\StructureManager::s_list1(array($array)))
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

        $structure = new Mock\Matks\Vivian\Structure\Structure('list', '#');

        $this
            ->string(BaseStructure\StructureManager::buildStructure($array, $structure))
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

        $structure = new Mock\Matks\Vivian\Structure\Structure('list', '-', '    ');

        $this
            ->string(BaseStructure\StructureManager::buildStructure($array, $structure))
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

        $borderMock = new Mock\Matks\Vivian\Border\Border('frame');
        $structure  = new Mock\Matks\Vivian\Structure\Structure('array', '', null, '|', $borderMock);

        $this
            ->string(BaseStructure\StructureManager::buildStructure($array, $structure))
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

        $structure = new Mock\Matks\Vivian\Structure\Structure('array', '', '    ', '=>', null);

        $this
            ->string(BaseStructure\StructureManager::buildStructure($array, $structure))
            ->isEqualTo($expectedArray);
    }

    public function testUnknownStructure()
    {
        $this
            ->exception(
                function () {
                    BaseStructure\StructureManager::unknown('foo');
                }
            )->hasMessage('Unknown structure function name unknown');
    }
}
