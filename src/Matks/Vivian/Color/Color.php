<?php

namespace Matks\Vivian\Color;

use Exception;

/**
 * Color functions
 *
 * Thanks Thijs Lensselink
 * @link http://blog.lenss.nl/2012/05/adding-colors-to-php-cli-script-output/
 */
class Color
{
    const BLACK  = 'black';
    const RED    = 'red';
    const GREEN  = 'green';
    const YELLOW = 'yellow';
    const BLUE   = 'blue';
    const PURPLE = 'purple';
    const CYAN   = 'cyan';
    const WHITE  = 'white';

    const BASH_PROMPT_BLACK  = 30;
    const BASH_PROMPT_RED    = 31;
    const BASH_PROMPT_GREEN  = 32;
    const BASH_PROMPT_YELLOW = 33;
    const BASH_PROMPT_BLUE   = 34;
    const BASH_PROMPT_PURPLE = 35;
    const BASH_PROMPT_CYAN   = 36;
    const BASH_PROMPT_WHITE  = 37;

    /**
     * Static calls to allow calls such as green('hello');
     */
    public static function __callstatic($name, $params)
    {
        $knownColors = static::getKnownColors();
        $colorID = $knownColors[$name];

        // target string is expected to be:
        $targetString = $params[0][0];

        return static::color($params[0][0], $colorID);
    }

    /**
     * Format given string in chosen color
     *
     * @param  string $string
     * @param  int    $colorID
     * @return string
     */
    public static function color($string, $colorID)
    {
        if (!in_array($colorID, static::getKnownColors())) {
            throw new Exception("Error unknown color ID $colorID");
        }

        $colorChar = "\033[".$colorID."m";
        $coloredString = $colorChar . $string . "\033[0m";

        return $coloredString;
    }

    /**
     * Get allowed colors
     *
     * @return array
     */
    public static function getKnownColors()
    {
        $colors = array(
            static::BLACK  => static::BASH_PROMPT_BLACK,
            static::RED    => static::BASH_PROMPT_RED,
            static::GREEN  => static::BASH_PROMPT_GREEN,
            static::YELLOW => static::BASH_PROMPT_YELLOW,
            static::BLUE   => static::BASH_PROMPT_BLUE,
            static::PURPLE => static::BASH_PROMPT_PURPLE,
            static::CYAN   => static::BASH_PROMPT_CYAN,
            static::WHITE  => static::BASH_PROMPT_WHITE
        );

        return $colors;
    }
}
