<?php

namespace Matks\Vivian\tests\Units\Border;

use Matks\Vivian\Border as BaseBorder;

use \atoum;

class Border extends atoum
{
    public function testConstruct()
    {
        $border = new BaseBorder\Border('underline');
    }

    public function testUnknownBorder()
    {
        $this
            ->exception(
                function () {
                    $border = new BaseBorder\Border('random');
                }
            )->hasMessage('Unknown border type random');
    }

    public function testGetters()
    {
        $border = new BaseBorder\Border('frame', 'a', 'b', 'c');

        $this
            ->string($border->getType())
            ->isEqualTo('frame')
            ->string($border->getLineCharacter())
            ->isEqualTo('a')
            ->string($border->getColumnCharacter())
            ->isEqualTo('b')
            ->string($border->getCrossCharacter())
            ->isEqualTo('c');
    }
}
