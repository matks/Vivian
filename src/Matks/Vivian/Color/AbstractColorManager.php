<?php

namespace Matks\Vivian\Color;

use Exception;

/**
 * Abstract Color manager
 */
abstract class AbstractColorManager
{
    const ANSI_ESCAPE_CODE_BEGIN = "\033[";
    const ANSI_ESCAPE_CODE_END   = 'm';

    /**
     * Get color
     *
     * @param int $colorID
     *
     * @return EscapeAttribute color
     */
    public static function color($colorID)
    {
        if (!in_array($colorID, static::getKnownColors())) {
            throw new Exception("Unknown color ID $colorID");
        }

        $colorClass = static::getColorClass();

        $color = new $colorClass($colorID);

        return $color;
    }

    /**
     * Get allowed colors
     *
     * @return array
     */
    abstract public static function getKnownColors();

    /**
     * Get Color class
     *
     * @return string
     */
    abstract public static function getColorClass();
}
