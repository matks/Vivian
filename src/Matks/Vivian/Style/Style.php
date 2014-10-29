<?php

namespace Matks\Vivian\Style;

use Exception;

/**
 * Style functions
 *
 * @link http://ascii-table.com/ansi-escape-sequences-vt-100.php
 */
class Style
{
    const BOLD      = 'bold';
    const UNDERLINE = 'underline';
    const BLINK     = 'blink';
    const INVISIBLE = 'invisible';

    const BASH_PROMPT_BOLD      = 1;
    const BASH_PROMPT_UNDERLINE = 4;
    const BASH_PROMPT_BLINK     = 5;
    const BASH_PROMPT_INVISIBLE = 8;

    /**
     * Static calls interface to allow calls such as green('hello');
     */
    public static function __callstatic($name, $params)
    {
        $knownStyles = static::getKnownStyles();
        $styleID     = $knownStyles[$name];

        // target string is expected to be:
        $targetString = $params[0][0];

        return static::style($targetString, $styleID);
    }

    /**
     * Format given string in chosen style
     *
     * @param string $string
     * @param int    $styleID
     *
     * @return string
     */
    public static function style($string, $styleID)
    {
        if (!in_array($styleID, static::getKnownStyles())) {
            throw new Exception("Error unknown style ID $styleID");
        }

        $styleChar    = "\033[" . $styleID . "m";
        $styledString = $styleChar . $string . "\033[0m";

        return $styledString;
    }

    /**
     * Get allowed styles
     *
     * @return array
     */
    public static function getKnownStyles()
    {
        $styles = array(
            static::BOLD      => static::BASH_PROMPT_BOLD,
            static::UNDERLINE => static::BASH_PROMPT_UNDERLINE,
            static::BLINK     => static::BASH_PROMPT_BLINK,
            static::INVISIBLE => static::BASH_PROMPT_INVISIBLE,
        );

        return $styles;
    }
}
