<?php

namespace Matks\Vivian\Color;

use Matks\Vivian\Output\TextElement;
use Exception;

/**
 * Background Color manager
 */
class BackgroundColorManager extends AbstractColorManager
{
    const BLACK  = 'black';
    const RED    = 'red';
    const GREEN  = 'green';
    const YELLOW = 'yellow';
    const BLUE   = 'blue';
    const PURPLE = 'purple';
    const CYAN   = 'cyan';
    const WHITE  = 'white';

    const BASH_BACKGROUND_BLACK  = 40;
    const BASH_BACKGROUND_RED    = 41;
    const BASH_BACKGROUND_GREEN  = 42;
    const BASH_BACKGROUND_YELLOW = 43;
    const BASH_BACKGROUND_BLUE   = 44;
    const BASH_BACKGROUND_PURPLE = 45;
    const BASH_BACKGROUND_CYAN   = 46;
    const BASH_BACKGROUND_WHITE  = 47;

    const BACKGROUND_COLOR_FUNCTION_NAME_REGEX = '^(back)_([a-zA-Z]*)$';

    /**
     * Static calls interface to allow calls such as back_green('hello');
     */
    public static function __callstatic($name, $params)
    {

        $matches = static::isBackgroundCall($name);

        if (null === $matches) {
            throw new Exception("Unknown background color function name $name");
        }

        $colorName   = $matches[2];
        $knownColors = static::getKnownColors();
        $colorID     = $knownColors[$colorName];

        if (!$colorID) {
            throw new Exception("Unknown background color name $name");
        }

        $color = static::color($colorID);

        // target string is expected to be:
        $targetString = $params[0][0];

        $element = new TextElement($targetString);
        $element->setBackgroundColor($color);

        return $element->render();
    }

    /**
     * Analyse function name
     *
     * @param string $functionName
     *
     * @return array|bool
     */
    public static function isBackgroundCall($functionName)
    {
        $matches = array();
        $pattern = '#' . static::BACKGROUND_COLOR_FUNCTION_NAME_REGEX . '#';

        if (!preg_match($pattern, $functionName, $matches)) {
            return false;
        }

        return $matches;
    }

    /**
     * Get allowed colors
     *
     * @return array
     */
    public static function getKnownColors()
    {
        $colors = array(
            static::BLACK  => static::BASH_BACKGROUND_BLACK,
            static::RED    => static::BASH_BACKGROUND_RED,
            static::GREEN  => static::BASH_BACKGROUND_GREEN,
            static::YELLOW => static::BASH_BACKGROUND_YELLOW,
            static::BLUE   => static::BASH_BACKGROUND_BLUE,
            static::PURPLE => static::BASH_BACKGROUND_PURPLE,
            static::CYAN   => static::BASH_BACKGROUND_CYAN,
            static::WHITE  => static::BASH_BACKGROUND_WHITE
        );

        return $colors;
    }

    /**
     * Get Color class
     *
     * @return string
     */
    public static function getColorClass()
    {
        return '\Matks\Vivian\Color\BackgroundColor';
    }
}
