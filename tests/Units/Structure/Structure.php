<?php

namespace Matks\Vivian\tests\Units\Structure;

use Matks\Vivian\Structure as BaseStructure;

use \atoum;
use Mock;

class Structure extends atoum
{
    public function testConstruct()
    {
        $structure = new BaseStructure\Structure('list');
    }

    public function testUnknownStructure()
    {
        $this
            ->exception(
                function () {
                    $structure = new BaseStructure\Structure('random');
                }
            )->hasMessage('Unknown structure type random');
    }

    public function testGetters()
    {
        $borderMock = new Mock\Matks\Vivian\Border\Border('underline');
        $structure  = new BaseStructure\Structure('array', 'a', 'b', 'c', $borderMock);

        $this
            ->string($structure->getType())
            ->isEqualTo('array')
            ->string($structure->getIteratorCharacter())
            ->isEqualTo('a')
            ->string($structure->getTab())
            ->isEqualTo('b')
            ->string($structure->getKeyToValueCharacter())
            ->isEqualTo('c')
            ->object($structure->getBorder())
            ->isEqualTo($borderMock);
    }
}
