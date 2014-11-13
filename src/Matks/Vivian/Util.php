<?php

namespace Matks\Vivian;

class Util
{
    const ESCAPE_CHARACTER_REGEX = '\\033\[\d+m';

    /**
     * Find longest string length among keys
     *
     * Only visible characters are considered
     *
     * @param array $array
     *
     * @return int
     */
    public static function getMaxKeyLength(array $array)
    {
        $maxKeyLength = '0';
        foreach ($array as $key => $value) {
            $currentLength = static::getVisibleStringLength($key);

            if ($currentLength > $maxKeyLength) {
                $maxKeyLength = $currentLength;
            }
        }

        return $maxKeyLength;
    }

    /**
     * Find longest string length among values
     *
     * Only visible characters are considered
     *
     * @param array $array
     *
     * @return int
     */
    public static function getMaxValueLength(array $array)
    {
        $maxValueLength = '0';
        foreach ($array as $value) {
            $currentLength = static::getVisibleStringLength($value);

            if ($currentLength > $maxValueLength) {
                $maxValueLength = $currentLength;
            }
        }

        return $maxValueLength;
    }

    /**
     * Build a string composed of $pattern repeated $length times
     *
     * @param string $pattern
     * @param int    $length
     *
     * @return string
     */
    public static function buildPatternLine($pattern, $length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $pattern;
        }

        return $result;
    }

    /**
     * Compute string length of only visible characters
     *
     * @param $string
     *
     * @return int
     */
    public static function getVisibleStringLength($string)
    {
        // remove escape characters
        $pattern     = '#' . static::ESCAPE_CHARACTER_REGEX . '#';
        $cleanString = preg_replace($pattern, '', $string);

        return strlen($cleanString);
    }
}
