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
    public static function getKnownColors()
    {
        // it is impossible to make abstract static functions since PHP 5.2
        throw new \RuntimeException('Do not use AbstractColorManager, use its children instead');
    }

    /**
     * Get Color class
     *
     * @return string
     */
    public static function getColorClass()
    {
        // it is impossible to make abstract static functions since PHP 5.2
        throw new \RuntimeException('Do not use AbstractColorManager, use its children instead');
    }
}
