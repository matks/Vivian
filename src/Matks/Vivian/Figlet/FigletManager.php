<?php

namespace Matks\Vivian\Figlet;

use Packaged\Figlet\Figlet as FigletEngine;
use Exception;

/**
 * Figlet manager
 *
 * @link http://www.figlet.org/
 */
class FigletManager
{
    const FIGLET_FUNCTION_NAME_REGEX = '^(figlet)_([a-zA-Z]*)$';

    /**
     * Static calls interface
     */
    public static function __callstatic($name, $params)
    {
        $matches = static::isFigletCall($name);

        if (null === $matches) {
            throw new Exception("Unknown figlet function name $name");
        }

        $fontName = $matches[2];

        // target string is expected to be:
        $targetString = $params[0][0];

        return static::render($targetString, $fontName);
    }

    /**
     * Compute text banner from given string
     *
     * @param string $string
     * @param string $fontName
     *
     * @return string
     */
    public static function render($string, $fontName)
    {
        if (!in_array($fontName, static::getKnownFonts())) {
            throw new Exception("Error unknown font ID fontID");
        }

        $figletString = FigletEngine::create($string, $fontName);

        return $figletString;
    }

    /**
     * Analyse function name
     *
     * @param string $functionName
     *
     * @return array|bool
     */
    public static function isFigletCall($functionName)
    {
        $matches = array();
        $pattern = '#' . static::FIGLET_FUNCTION_NAME_REGEX . '#';

        if (!preg_match($pattern, $functionName, $matches)) {
            return false;
        }

        return $matches;
    }

    /**
     * Get provided fonts
     *
     * The fonts provided are the one packaged in vendor packaged/figlet
     *
     * @return array
     */
    public static function getKnownFonts()
    {
        $fontNames = array(
            'banner',
            'big',
            'block',
            'bubble',
            'digital',
            'ivrit',
            'lean',
            'mini',
            'script',
            'shadow',
            'slant',
            'small',
            'smscript',
            'smshadow',
            'smslant',
            'speed',
            'standard',
            'term'
        );

        return $fontNames;
    }
}
