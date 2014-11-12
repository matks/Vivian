<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class TextColor extends atoum
{
    public function testConstruct()
    {
        $color = new Color\TextColor(33);

        $this
            ->class(get_class($color))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testGetters()
    {
        $color = new Color\TextColor(37);

        $this
            ->string($color->getEscapeCharacter())
            ->isEqualTo("\033[37m");
    }
}
