<?php

namespace Matks\Vivian\Style;

use Matks\Vivian\Output\TextElement;
use Exception;

/**
 * Style manager
 *
 * @link http://ascii-table.com/ansi-escape-sequences-vt-100.php
 */
class StyleManager
{
    const BOLD      = 'bold';
    const UNDERLINE = 'underline';
    const BLINK     = 'blink';
    const INVISIBLE = 'invisible';

    const BASH_BOLD      = 1;
    const BASH_UNDERLINE = 4;
    const BASH_BLINK     = 5;
    const BASH_INVISIBLE = 8;

    /**
     * Static calls interface
     */
    public static function __callstatic($name, $params)
    {
        $knownStyles = static::getKnownStyles();
        $styleID     = $knownStyles[$name];

        $style = static::style($styleID);

        // target string is expected to be:
        $targetString = $params[0][0];

        $element = new TextElement($targetString);
        $element->addStyle($style);

        return $element->render();
    }

    /**
     * Format given string in chosen style
     *
     * @param string $string
     * @param int    $styleID
     *
     * @return string
     */
    public static function style($styleID)
    {
        if (!in_array($styleID, static::getKnownStyles())) {
            throw new Exception("Unknown style ID $styleID");
        }

        $style = new Style($styleID);

        return $style;
    }

    /**
     * Get allowed styles
     *
     * @return array
     */
    public static function getKnownStyles()
    {
        $styles = array(
            static::BOLD      => static::BASH_BOLD,
            static::UNDERLINE => static::BASH_UNDERLINE,
            static::BLINK     => static::BASH_BLINK,
            static::INVISIBLE => static::BASH_INVISIBLE,
        );

        return $styles;
    }
}
