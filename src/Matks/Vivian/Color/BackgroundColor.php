<?php

namespace Matks\Vivian\Color;

use Matks\Vivian\Color\BackgroundColorManager;
use Matks\Vivian\Output\EscapeAttribute;

/**
 * Color
 */
class BackgroundColor extends EscapeAttribute
{

    /**
     * {@inheritdoc }
     */
    protected function getAllowedEscapeCodes()
    {
        $knownColors = BackgroundColorManager::getKnownColors();

        $escapeCodes = array();
        foreach ($knownColors as $color) {
            $code          = "\033[" . $color . "m";
            $escapeCodes[] = $code;
        }

        return $escapeCodes;
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
}
