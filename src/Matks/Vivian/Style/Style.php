<?php

namespace Matks\Vivian\Style;

use Matks\Vivian\Style\StyleManager;
use Matks\Vivian\Output\EscapeAttribute;

/**
 * Style
 */
class Style extends EscapeAttribute
{
    /**
     * {@inheritdoc }
     */
    protected function getAllowedEscapeCodes()
    {
        $knownStyles = StyleManager::getKnownStyles();

        $escapeCodes = array();
        foreach ($knownStyles as $style) {
            $code          = "\033[" . $style . "m";
            $escapeCodes[] = $code;
        }

        return $escapeCodes;
    }
}
