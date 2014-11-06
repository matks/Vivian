<?php

namespace Matks\Vivian\Color;

use Matks\Vivian\Color\TextColorManager;
use Matks\Vivian\Output\EscapeAttribute;

/**
 * Color
 */
class TextColor extends EscapeAttribute
{

    /**
     * {@inheritdoc }
     */
    protected function getAllowedEscapeCodes()
    {
        $knownColors = TextColorManager::getKnownColors();

        return $knownColors;
    }
}
