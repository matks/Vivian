<?php

namespace Matks\Vivian\tests\Units\Color;

use Matks\Vivian\Color;

use \atoum;

class BackgroundColor extends atoum
{
    public function testConstruct()
    {
        $bgColor = new Color\BackgroundColor(43);

        $this
            ->class(get_class($bgColor))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testForbiddenColor()
    {
        $this
            ->exception(
                function () {
                    $bgColor = new Color\BackgroundColor(100);
                }
            )->hasMessage('Forbidden code 100');
    }

    public function testGetters()
    {
        $bgColor = new Color\BackgroundColor(47);

        $this
            ->string($bgColor->getEscapeCharacter())
            ->isEqualTo("\033[47m");
    }
}
