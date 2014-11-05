<?php

namespace Matks\Vivian\tests\Units\Style;

use Matks\Vivian\Style as BaseStyle;

use \atoum;

class Style extends atoum
{
    public function testConstruct()
    {
        $style = new BaseStyle\Style('test style', 1);

        $this
            ->class(get_class($style))
            ->isSubClassOf('\Matks\Vivian\Output\EscapeAttribute');
    }

    public function testForbiddenCode()
    {
        $this
            ->exception(
                function () {
                    $style = new BaseStyle\Style('bad style', 100);
                }
            )->hasMessage('Forbidden code 100');
    }

    public function testToString()
    {
        $style = new BaseStyle\Style('test Style', 8);

        $this
            ->string('' . $style)
            ->isEqualTo('test Style');
    }

    public function testGetters()
    {
        $style = new BaseStyle\Style('test Style', 4);

        $this
            ->string($style->getName())
            ->isEqualTo('test Style')
            ->string($style->getEscapeCode())
            ->isEqualTo("\033[4m");
    }
}
