<?php

namespace Matks\Vivian\tests\Units\Output;

use Matks\Vivian\Output;

use \atoum;
use Mock;

class BorderedElement extends atoum
{
    public function testConstruct()
    {
        $borderMock      = new Mock\Matks\Vivian\Border\Border('underline');
        $borderedElement = new Output\BorderedElement('a', $borderMock);

        $this
            ->class(get_class($borderedElement))
            ->isSubClassOf('\Matks\Vivian\Output\TextElement')
            ->object($borderedElement->getBorder())
            ->isEqualTo($borderMock);
    }

    public function testRender()
    {
        $borderMock      = new Mock\Matks\Vivian\Border\Border('underline');
        $borderedElement = new Output\BorderedElement('lol', $borderMock);

        $borderMock->getMockController()->getLineCharacter = '#';

        $renderedElement = $borderedElement->render();
        $expectedString  = 'lol' . PHP_EOL . '###' . PHP_EOL;

        $this
            ->string($renderedElement)
            ->isEqualTo($expectedString);
    }
}
