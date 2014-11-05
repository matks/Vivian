<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class ForegroundColor extends atoum
{
    public function testConstruct()
    {
        $color = new Color\ForegroundColor('test color', 33);

        $this
            ->class(get_class($color))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testToString()
    {
        $color = new Color\ForegroundColor('test color', 33);

        $this
            ->string('' . $color)
            ->isEqualTo('test color');
    }

    public function testGetters()
    {
        $color = new Color\ForegroundColor('test color', 37);

        $this
            ->string($color->getName())
            ->isEqualTo('test color')
            ->string($color->getEscapeCode())
            ->isEqualTo("\033[37m");
    }
}
