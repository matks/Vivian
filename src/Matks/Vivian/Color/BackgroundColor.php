<?php

namespace Matks\Vivian\Color;

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

        return $knownColors;
    }
}
