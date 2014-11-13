<?php

namespace Matks\Vivian\tests\Units\Output;

use Matks\Vivian\Output;

use \atoum;
use Mock;

class StructuredElements extends atoum
{
    public function testConstruct()
    {
        $textElement1 = new Mock\Matks\Vivian\Output\TextElement('a');
        $textElement2 = new Mock\Matks\Vivian\Output\TextElement('b');
        $textElement3 = new Mock\Matks\Vivian\Output\TextElement('c');

        $array = array(
            $textElement1,
            $textElement2,
            $textElement3
        );

        $structureMock      = new Mock\Matks\Vivian\Structure\Structure('list');
        $structuredElements = new Output\StructuredElements($array, $structureMock);

        $this
            ->object($structuredElements->getStructure())
            ->isEqualTo($structureMock);
    }

    public function testRenderSimpleList()
    {
        $textElement1 = new Mock\Matks\Vivian\Output\TextElement('a');
        $textElement2 = new Mock\Matks\Vivian\Output\TextElement('b');
        $textElement3 = new Mock\Matks\Vivian\Output\TextElement('c');

        $array = array(
            $textElement1,
            $textElement2,
            $textElement3
        );

        $structureMock      = new Mock\Matks\Vivian\Structure\Structure('list');
        $structuredElements = new Output\StructuredElements($array, $structureMock);

        $renderedElement = $structuredElements->render();
        $expectedString  = '# a' . PHP_EOL . '# b' . PHP_EOL . '# c' . PHP_EOL;

        $this
            ->string($renderedElement)
            ->isEqualTo($expectedString);
    }

    public function testRenderComplexList()
    {
        $textElement1 = new Mock\Matks\Vivian\Output\TextElement('a');
        $textElement2 = new Mock\Matks\Vivian\Output\TextElement('b');
        $textElement3 = new Mock\Matks\Vivian\Output\TextElement('c');

        $styleMock   = new Mock\Matks\Vivian\Style\Style(1);
        $colorMock   = new Mock\Matks\Vivian\Color\TextColor(31);
        $bgColorMock = new Mock\Matks\Vivian\Color\BackgroundColor(42);

        $textElement1->addStyle($styleMock);
        $textElement2->setTextColor($colorMock);
        $textElement3->setBackgroundColor($bgColorMock);

        $array = array(
            $textElement1,
            $textElement2,
            $textElement3
        );

        $structureMock      = new Mock\Matks\Vivian\Structure\Structure('list', '*', '    ', '=>');
        $structuredElements = new Output\StructuredElements($array, $structureMock);

        $renderedElement = $structuredElements->render();
        $expectedString  = "    * \033[1ma\033[0m" . PHP_EOL;
        $expectedString .= "    * \033[31mb\033[0m" . PHP_EOL;
        $expectedString .= "    * \033[42mc\033[0m" . PHP_EOL;

        $this
            ->string($renderedElement)
            ->isEqualTo($expectedString);
    }

    public function testRenderSimpleArray()
    {
        $textElement1 = new Mock\Matks\Vivian\Output\TextElement('a');
        $textElement2 = new Mock\Matks\Vivian\Output\TextElement('b');
        $textElement3 = new Mock\Matks\Vivian\Output\TextElement('cd');

        $array = array(
            $textElement1,
            $textElement2,
            $textElement3
        );

        $borderMock         = new Mock\Matks\Vivian\Border\Border('frame');
        $structureMock      = new Mock\Matks\Vivian\Structure\Structure('array', null, null, '|', $borderMock);
        $structuredElements = new Output\StructuredElements($array, $structureMock);

        $renderedElement = $structuredElements->render();
        $expectedString  = '+---+----+' . PHP_EOL;
        $expectedString .= '| 0 | a  |' . PHP_EOL;
        $expectedString .= '| 1 | b  |' . PHP_EOL;
        $expectedString .= '| 2 | cd |' . PHP_EOL;
        $expectedString .= '+---+----+' . PHP_EOL;

        $this
            ->string($renderedElement)
            ->isEqualTo($expectedString);
    }

    public function testRenderComplexArray()
    {
        $textElement1 = new Mock\Matks\Vivian\Output\TextElement('aa');
        $textElement2 = new Mock\Matks\Vivian\Output\TextElement('b');
        $textElement3 = new Mock\Matks\Vivian\Output\TextElement('ccc');

        $styleMock   = new Mock\Matks\Vivian\Style\Style(1);
        $colorMock   = new Mock\Matks\Vivian\Color\TextColor(31);
        $bgColorMock = new Mock\Matks\Vivian\Color\BackgroundColor(42);

        $textElement1->addStyle($styleMock);
        $textElement2->setTextColor($colorMock);
        $textElement3->setBackgroundColor($bgColorMock);

        $array = array(
            2  => $textElement1,
            4  => $textElement2,
            66 => $textElement3
        );

        $borderMock         = new Mock\Matks\Vivian\Border\Border('frame', '_', '$', '@');
        $structureMock      = new Mock\Matks\Vivian\Structure\Structure('array', null, '    ', '$', $borderMock);
        $structuredElements = new Output\StructuredElements($array, $structureMock);

        $renderedElement = $structuredElements->render();

        $expectedString = "    @____@_____@" . PHP_EOL;
        $expectedString .= "    $ 2  $ \033[1maa\033[0m  $" . PHP_EOL;
        $expectedString .= "    $ 4  $ \033[31mb\033[0m   $" . PHP_EOL;
        $expectedString .= "    $ 66 $ \033[42mccc\033[0m $" . PHP_EOL;
        $expectedString .= "    @____@_____@" . PHP_EOL;

        $this
            ->string($renderedElement)
            ->isEqualTo($expectedString);
    }
}
