<?php

namespace Matks\Vivian\Color;

use Exception;

/**
 * Abstract Color manager
 */
abstract class AbstractColorManager
{
    const ANSI_ESCAPE_CODE_REGEX_BEGIN = '\\033\[';
    const ANSI_ESCAPE_CODE_REGEX_END   = 'm';

    /**
     * Format given string in chosen color
     *
     * @param string $string
     * @param int    $colorID
     *
     * @return string
     */
    public static function color($string, $colorID)
    {
        if (!in_array($colorID, static::getKnownColors())) {
            throw new Exception("Unknown color ID $colorID");
        }

        $isAlreadyColored = static::isAlreadyColored($string);
        if ($isAlreadyColored) {
            throw new Exception('Given string already contains a color escape code');
        }

        $colorChar     = "\033[" . $colorID . "m";
        $coloredString = $colorChar . $string . "\033[0m";

        return $coloredString;
    }

    /**
     * Get allowed colors
     *
     * @return array
     */
    public abstract static function getKnownColors();

    /**
     * Check if given string already contains color escape code
     *
     * @param $string
     *
     * @return boolean
     */
    protected static function isAlreadyColored($string)
    {
        $knownColors          = static::getKnownColors();
        $colorsFormattedList  = '(' . implode('|', $knownColors) . ')';
        $coloredStringPattern = '#' . static::ANSI_ESCAPE_CODE_REGEX_BEGIN;
        $coloredStringPattern .= $colorsFormattedList . static::ANSI_ESCAPE_CODE_REGEX_END . '#';

        $result = preg_match($coloredStringPattern, $string);

        return (boolean)$result;
    }
}
