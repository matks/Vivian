<?php

namespace Matks\Vivian\Color;

use Matks\Vivian\Color\ForegroundColorManager;
use Matks\Vivian\Output\EscapeAttribute;

/**
 * Color
 */
class ForegroundColor extends EscapeAttribute
{

    /**
     * {@inheritdoc }
     */
    protected function getAllowedEscapeCodes()
    {
        $knownColors = ForegroundColorManager::getKnownColors();

        $escapeCodes = array();
        foreach ($knownColors as $color) {
            $code          = "\033[" . $color . "m";
            $escapeCodes[] = $code;
        }

        return $escapeCodes;
    }
}
