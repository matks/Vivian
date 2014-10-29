<?php

namespace Matks\Vivian;

class Util
{
    /**
     * Find longest string length among keys
     *
     * @param  array $array
     *
     * @return integer
     */
    public static function getMaxKeyLength(array $array)
    {
        $maxKeyLength = '0';
        foreach ($array as $key => $value) {
            $currentLength = strlen($key);

            if ($currentLength > $maxKeyLength) {
                $maxKeyLength = $currentLength;
            }
        }

        return $maxKeyLength;
    }

    /**
     * Find longest string length among values
     *
     * @param  array $array
     *
     * @return integer
     */
    public static function getMaxValueLength(array $array)
    {
        $maxValueLength = '0';
        foreach ($array as $value) {
            $currentLength = strlen($value);

            if ($currentLength > $maxValueLength) {
                $maxValueLength = $currentLength;
            }
        }

        return $maxValueLength;
    }

    /**
     * Build a string composed of $pattern repeated $length times
     *
     * @param string  $pattern
     * @param integer $length
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
}
