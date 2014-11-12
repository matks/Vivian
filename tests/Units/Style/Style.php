<?php

namespace Matks\Vivian\tests\Units\Style;

use Matks\Vivian\Style as BaseStyle;

use \atoum;

class Style extends atoum
{
    public function testConstruct()
    {
        $style = new BaseStyle\Style(1);

        $this
            ->class(get_class($style))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testForbiddenCode()
    {
        $this
            ->exception(
                function () {
                    $style = new BaseStyle\Style(100);
                }
            )->hasMessage('Forbidden code 100');
    }

    public function testGetters()
    {
        $style = new BaseStyle\Style(4);

        $this
            ->string($style->getEscapeCharacter())
            ->isEqualTo("\033[4m");
    }
}
