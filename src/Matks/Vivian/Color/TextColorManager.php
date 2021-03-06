<?php

namespace Matks\Vivian\Color;

use Matks\Vivian\Output\TextElement;

/**
 * Foreground Color manager
 *
 * Thanks Thijs Lensselink
 *
 * @link http://blog.lenss.nl/2012/05/adding-colors-to-php-cli-script-output/
 */
class TextColorManager extends AbstractColorManager
{
    const BLACK  = 'black';
    const RED    = 'red';
    const GREEN  = 'green';
    const YELLOW = 'yellow';
    const BLUE   = 'blue';
    const PURPLE = 'purple';
    const CYAN   = 'cyan';
    const WHITE  = 'white';

    const BASH_FOREGROUND_BLACK  = 30;
    const BASH_FOREGROUND_RED    = 31;
    const BASH_FOREGROUND_GREEN  = 32;
    const BASH_FOREGROUND_YELLOW = 33;
    const BASH_FOREGROUND_BLUE   = 34;
    const BASH_FOREGROUND_PURPLE = 35;
    const BASH_FOREGROUND_CYAN   = 36;
    const BASH_FOREGROUND_WHITE  = 37;

    /**
     * Static calls interface to allow calls such as green('hello');
     */
    public static function __callstatic($name, $params)
    {
        $knownColors = static::getKnownColors();
        $colorID     = $knownColors[$name];

        $color = static::color($colorID);

        // target string is expected to be:
        $targetString = $params[0][0];

        $element = new TextElement($targetString);
        $element->setTextColor($color);

        return $element->render();
    }

    /**
     * Get allowed colors
     *
     * @return string[]
     */
    public static function getKnownColors()
    {
        $colors = array(
            static::BLACK  => static::BASH_FOREGROUND_BLACK,
            static::RED    => static::BASH_FOREGROUND_RED,
            static::GREEN  => static::BASH_FOREGROUND_GREEN,
            static::YELLOW => static::BASH_FOREGROUND_YELLOW,
            static::BLUE   => static::BASH_FOREGROUND_BLUE,
            static::PURPLE => static::BASH_FOREGROUND_PURPLE,
            static::CYAN   => static::BASH_FOREGROUND_CYAN,
            static::WHITE  => static::BASH_FOREGROUND_WHITE
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
        return '\Matks\Vivian\Color\TextColor';
    }
}
