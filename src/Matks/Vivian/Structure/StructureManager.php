<?php

namespace Matks\Vivian\Structure;

use Matks\Vivian\Util;
use Exception;

/**
 * Structures (array printing) manager
 */
class StructureManager
{
    /**
     * PHP does not allow use of function names
     * such as 'list' or 'array'
     */
    const ARRAY_STANDARD = 's_array';
    const ARRAY_PHP      = 's_phpArray';
    const ARRAY_LIST     = 's_list1';
    const ARRAY_LIST2    = 's_list2';
    const ARRAY_MATRIX   = 's_matrix';

    const TAB = '    ';

    /**
     * Static calls interface
     */
    public static function __callstatic($name, $params)
    {
        if (!in_array($name, static::getDisplayableStructures())) {
            throw new Exception("Unknown structure function name $name");
        }

        // target string is expected to be:
        $target       = $params[0][0];
        $functionName = '__' . $name;

        return static::$functionName($target);
    }

    public static function __s_list1($list)
    {
        return static::buildList($list);
    }

    public static function __s_list2($list)
    {
        return static::buildList($list, '-', true);
    }

    public static function __s_array($array)
    {
        return static::buildArray($array);
    }

    public static function __s_phpArray($array)
    {
        return static::buildPHPArray($array);
    }

    public static function __s_matrix($array)
    {
        throw new \RuntimeException('Not implemented yet');
    }

    /**
     * Get implemented data structures display
     *
     * @return array
     */
    public static function getDisplayableStructures()
    {
        $structures = array(
            static::ARRAY_STANDARD,
            static::ARRAY_PHP,
            static::ARRAY_LIST,
            static::ARRAY_LIST2,
            static::ARRAY_MATRIX
        );

        return $structures;
    }

    private static function buildList($list, $iteratorChracter = '#', $tab = false)
    {
        $result = '';
        foreach ($list as $value) {
            $result .= ($tab ? static::TAB : '') . $iteratorChracter . ' ' . $value . PHP_EOL;
        }

        return $result;
    }

    private static function buildArray($array, $lineCharacter = '-', $columnCharacter = '|', $crossCharacter = '+')
    {
        $maxKeyLength   = Util::getMaxKeyLength($array);
        $maxValueLength = Util::getMaxValueLength($array);

        $result = '';

        // first line
        $keyBorderLine   = Util::buildPatternLine($lineCharacter, $maxKeyLength + 2);
        $valueBorderLine = Util::buildPatternLine($lineCharacter, $maxValueLength + 2);
        $result .= $crossCharacter . $keyBorderLine . $crossCharacter;
        $result .= $valueBorderLine . $crossCharacter . PHP_EOL;

        // array lines
        foreach ($array as $key => $value) {
            $keyLength        = Util::getVisibleStringLength($key);
            $missingKeyLength = $maxKeyLength - $keyLength;
            $fillingKeySpace  = Util::buildPatternLine(' ', $missingKeyLength);

            $valueLength        = Util::getVisibleStringLength($value);
            $missingValueLength = $maxValueLength - $valueLength;
            $fillingValueSpace  = Util::buildPatternLine(' ', $missingValueLength);

            $result .= $columnCharacter . ' ' . $key . $fillingKeySpace . ' ';
            $result .= $columnCharacter . ' ' . $value . $fillingValueSpace . ' ';
            $result .= $columnCharacter . PHP_EOL;
        }

        $result .= $crossCharacter . $keyBorderLine . $crossCharacter;
        $result .= $valueBorderLine . $crossCharacter . PHP_EOL;

        return $result;
    }

    private static function buildPHPArray($array, $iteratorChracter = '', $linkCharacter = '=>', $tab = true)
    {
        $maxKeyLength = Util::getMaxKeyLength($array);

        $result = '';
        foreach ($array as $key => $value) {
            $keyLength     = Util::getVisibleStringLength($key);
            $missingLength = $maxKeyLength - $keyLength;
            $fillingSpace  = Util::buildPatternLine(' ', $missingLength);

            $result .= ($tab ? static::TAB : '') . (($iteratorChracter) ? $iteratorChracter . ' ' : '');
            $result .= $key . ' ' . $fillingSpace . $linkCharacter . ' ' . $value . PHP_EOL;
        }

        return $result;
    }
}
