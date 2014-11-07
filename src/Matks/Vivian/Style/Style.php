<?php

namespace Matks\Vivian\Style;

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

        return $knownStyles;
    }
}
