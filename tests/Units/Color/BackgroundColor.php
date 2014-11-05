<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class BackgroundColor extends atoum
{
    public function testConstruct()
    {
        $bgColor = new Color\BackgroundColor('test color', 43);

        $this
            ->class(get_class($bgColor))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testForbiddenColor()
    {
        $this
            ->exception(
                function () {
                    $bgColor = new Color\BackgroundColor('bad color', 100);
                }
            )->hasMessage('Forbidden code 100');
    }

    public function testToString()
    {
        $bgColor = new Color\BackgroundColor('test color', 41);

        $this
            ->string('' . $bgColor)
            ->isEqualTo('test color');
    }

    public function testGetters()
    {
        $bgColor = new Color\BackgroundColor('test color', 47);

        $this
            ->string($bgColor->getName())
            ->isEqualTo('test color')
            ->string($bgColor->getEscapeCode())
            ->isEqualTo("\033[47m");
    }
}
