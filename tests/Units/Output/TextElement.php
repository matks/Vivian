<?php

namespace Matks\Vivian\tests\Units\Output;

use Matks\Vivian\Output;

use \atoum;
use Mock;

class TextElement extends atoum
{
    public function testConstruct()
    {
        $TextElement = new Output\TextElement('test TextElement');

        $this
            ->string($TextElement->getText())
            ->isEqualTo('test TextElement')
            ->string('' . $TextElement)
            ->isEqualTo('test TextElement');
    }

    public function testSetColor()
    {
        $textElement = new Output\TextElement('test TextElement');

        $color1 = new Mock\Matks\Vivian\Color\TextColor(33);
        $textElement->setTextColor($color1);

        $this
            ->object($textElement->getTextColor())
            ->isEqualTo($color1);

        $color2 = new Mock\Matks\Vivian\Color\TextColor(37);
        $textElement->setTextColor($color2);

        $this
            ->object($textElement->getTextColor())
            ->isEqualTo($color2);
    }

    public function testSetBackgroundColor()
    {
        $textElement = new Output\TextElement('test TextElement');

        $color1 = new Mock\Matks\Vivian\Color\BackgroundColor(43);
        $textElement->setBackgroundColor($color1);

        $this
            ->object($textElement->getBackgroundColor())
            ->isEqualTo($color1);

        $color2 = new Mock\Matks\Vivian\Color\BackgroundColor(47);
        $textElement->setBackgroundColor($color2);

        $this
            ->object($textElement->getBackgroundColor())
            ->isEqualTo($color2);
    }

    public function testAddStyle()
    {
        $textElement = new Output\TextElement('test TextElement');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(1);

        $this
            ->variable($textElement->getStyles())
            ->isNull();

        $textElement->addStyle($style1);
        $textElement->addStyle($style2);

        $this
            ->array($textElement->getStyles())
            ->isEqualTo(array($style1, $style2));
    }

    public function testRemoveStyle()
    {
        $textElement = new Output\TextElement('test TextElement');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(1);

        $textElement->addStyle($style1);
        $textElement->addStyle($style2);
        $textElement->removeStyle($style1);

        $this
            ->array($textElement->getStyles())
            ->isEqualTo(array($style2));
    }

    public function testRender()
    {
        $textElement = new Output\TextElement('test TextElement');

        $style1 = new Mock\Matks\Vivian\Style\Style(1);
        $style2 = new Mock\Matks\Vivian\Style\Style(5);

        $textColor = new Mock\Matks\Vivian\Color\TextColor(33);
        $bgColor   = new Mock\Matks\Vivian\Color\BackgroundColor(41);

        $textElement->setTextColor($textColor)
            ->setBackgroundColor($bgColor)
            ->addStyle($style1)
            ->addStyle($style2);

        $output         = $textElement->render();
        $expectedString = "\033[5m\033[1m\033[41m\033[33mtest TextElement\033[0m\033[0m\033[0m\033[0m";

        $this
            ->string($output)
            ->isEqualTo($expectedString);
    }

    public function testWrongString()
    {
        $this
            ->exception(
                function () {
                    $textElement = new Output\TextElement("\033[32mfoo\033[0m");
                }
            )->hasMessage('Given text contains an escape code');
    }
}
