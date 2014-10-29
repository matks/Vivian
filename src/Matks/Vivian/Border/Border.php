<?php

namespace Matks\Vivian\Border;

use Matks\Vivian\Util;

/**
 * Border functions
 */
class Border
{
    const STYLE_UNDERLINE        = 'underline';
    const STYLE_DOUBLE_UNDERLINE = 'doubleUnderline';
    const STYLE_BORDER           = 'border';
    const STYLE_DOUBLE_BORDER    = 'doubleBorder';

    /**
     * Static calls interface
     */
    public static function __callstatic($name, $params)
    {
        // target string is expected to be:
        $targetString = $params[0][0];
        $functionName = '__'.$name;

        return static::$functionName($targetString);
    }

    /**
     * Underline a string with '-'
     *
     * Be careful, this adds two end-of-line
     *
     * @param  string $string
     * @return string
     */
    public static function __underline($string)
    {
        return static::buildUnderline($string);
    }

    /**
     * Underline a string with '='
     *
     * Be careful, this adds two end-of-line
     *
     * @param  string $string
     * @return string
     */
    public static function __doubleUnderline($string)
    {
        return static::buildUnderline($string, '=');
    }

    /**
     * Draw a border around a string
     *
     * @param  string $string
     * @return string
     */
    public static function __border($string)
    {
        return static::buildBorder($string);
    }

    /**
     * Draw a double border around a string
     *
     * @param  string $string
     * @return string
     */
    public static function __doubleBorder($string)
    {
        return static::buildBorder($string, '=', '#', '*');
    }

    /**
     * Get allowed styles
     *
     * @return array
     */
    public static function getKnownBorders()
    {
        $styles = array(
            static::STYLE_UNDERLINE,
            static::STYLE_DOUBLE_UNDERLINE,
            static::STYLE_BORDER,
            static::STYLE_DOUBLE_BORDER
        );

        return $styles;
    }

    private static function buildUnderline($string, $lineCharacter = '-')
    {
        $stringLength = strlen($string);
        $underline = Util::buildPatternLine($lineCharacter, $stringLength);

        $result = $string . PHP_EOL . $underline . PHP_EOL;

        return $result;
    }

    private static function buildBorder($string, $lineCharacter = '-', $columnCharacter = '|', $crossCharacter = '+')
    {
        $stringLength = strlen($string);

        $line = Util::buildPatternLine($lineCharacter, $stringLength + 2);

        $firstLine = $crossCharacter . $line   . $crossCharacter;
        $mainLine  = $columnCharacter . ' ' . $string . ' ' . $columnCharacter;
        $lastLine  = $firstLine;

        $result = $firstLine . PHP_EOL . $mainLine . PHP_EOL . $lastLine . PHP_EOL;

        return $result;
    }
}
