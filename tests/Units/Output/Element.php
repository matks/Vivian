<?php

namespace Matks\Vivian\tests\Units\Output;

use Matks\Vivian\Output;

use \atoum;
use Mock;

class Element extends atoum
{
    public function testConstruct()
    {
        $element = new Output\Element('test element');

        $this
            ->string($element->getText())
            ->isEqualTo('test element')
            ->string('' . $element)
            ->isEqualTo('test element');
    }

    public function testSetColor()
    {
        $element = new Output\Element('test element');

        $color1 = new Mock\Matks\Vivian\Color\TextColor(33);
        $element->setTextColor($color1);

        $this
            ->object($element->getTextColor())
                ->isEqualTo($color1);

        $color2 = new Mock\Matks\Vivian\Color\TextColor(37);
        $element->setTextColor($color2);

        $this
            ->object($element->getTextColor())
            ->isEqualTo($color2);
    }

    public function testSetBackgroundColor()
    {
        $element = new Output\Element('test element');

        $color1 = new Mock\Matks\Vivian\Color\BackgroundColor(43);
        $element->setBackgroundColor($color1);

        $this
            ->object($element->getBackgroundColor())
            ->isEqualTo($color1);

        $color2 = new Mock\Matks\Vivian\Color\BackgroundColor(47);
        $element->setBackgroundColor($color2);

        $this
            ->object($element->getBackgroundColor())
            ->isEqualTo($color2);
    }

    public function testAddStyle()
    {
        $element = new Output\Element('test element');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(1);

        $this
            ->variable($element->getStyles())
            ->isNull();

        $element->addStyle($style1);
        $element->addStyle($style2);

        $this
            ->array($element->getStyles())
            ->isEqualTo(array($style1, $style2));
    }

    public function testRemoveStyle()
    {
        $element = new Output\Element('test element');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(1);

        $element->addStyle($style1);
        $element->addStyle($style2);
        $element->removeStyle($style1);

        $this
            ->array($element->getStyles())
            ->isEqualTo(array($style2));
    }

    public function testRender()
    {
        $element = new Output\Element('test element');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(5);

        $textColor = new Mock\Matks\Vivian\Color\TextColor(33);
        $bgColor   = new Mock\Matks\Vivian\Color\BackgroundColor(41);

        $element->setTextColor($textColor)
                ->setBackgroundColor($bgColor)
                ->addStyle($style1)
                ->addStyle($style2)
        ;

        $output = $element->render();
        $expectedString = "\033[5m\033[1m\033[41m\033[33mtest element\033[0m\033[0m\033[0m\033[0m";

        $this
            ->string($output)
                ->isEqualTo($expectedString);
    }

    public function testWrongString()
    {
        $this
            ->exception(
                function () {
                    $element = new Output\Element("\033[32mfoo\033[0m");
                }
            )->hasMessage('Given text contains an escape code');
    }
}
