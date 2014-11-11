<?php

namespace Matks\Vivian\Structure;

use Matks\Vivian\Border\Border;
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

    /**
     * Render array displayed as structure
     *
     * @param array     $array
     * @param Structure $structure
     *
     * @return string
     * @throws Exception
     */
    public static function buildStructure($array, Structure $structure)
    {
        switch ($structure->getType()) {
            case Structure::TYPE_LIST:
                $result = static::buildList($array, $structure);
                break;
            case Structure::TYPE_ARRAY:
                $result = static::buildArray($array, $structure);
                break;
            default:
                throw new Exception('Unknown structure type ' . $structure->getType());
        }

        return $result;
    }

    /**
     * Shortcut to render a list
     *
     * @param $list
     *
     * @return string
     */
    private static function __s_list1($list)
    {
        $structure = new Structure(Structure::TYPE_LIST);

        return static::buildStructure($list, $structure);
    }

    /**
     * Shortcut to render a list
     *
     * @param $list
     *
     * @return string
     */
    private static function __s_list2($list)
    {
        $structure = new Structure(Structure::TYPE_LIST, '-', Structure::FOUR_SPACE_TAB);

        return static::buildStructure($list, $structure);
    }

    /**
     * Shortcut to render an array with borders
     *
     * @param $array
     *
     * @return string
     */
    private static function __s_array($array)
    {
        $border = new Border(Border::TYPE_FRAME);
        $structure = new Structure(Structure::TYPE_ARRAY, '', null, '|', $border);

        return static::buildStructure($array, $structure);
    }

    /**
     * Shortcut to render an array as a php array declaration
     *
     * @param $array
     *
     * @return string
     */
    private static function __s_phpArray($array)
    {
        $structure = new Structure(Structure::TYPE_ARRAY, '', Structure::FOUR_SPACE_TAB, '=>');

        return static::buildStructure($array, $structure);
    }

    /**
     * Shortcut to render a matrix
     *
     * @param $array
     *
     * @throws \RuntimeException
     */
    private static function __s_matrix($array)
    {
        throw new \RuntimeException('Not implemented yet');
    }

    /**
     * Render a structure of type 'list
     *
     * @param array     $list
     * @param Structure $structure
     *
     * @return string
     */
    private static function buildList(array $list, Structure $structure)
    {
        $insertTab = ($structure->getTab()) ? true : false;

        $result = '';
        foreach ($list as $value) {
            $result .= ($insertTab ? $structure->getTab() : '') . $structure->getIteratorCharacter() . ' ' . $value . PHP_EOL;
        }

        return $result;
    }

    /**
     * Render a structure of type 'array'
     *
     * @param array     $array
     * @param Structure $structure
     *
     * @return string
     */
    private static function buildArray(array $array, Structure $structure)
    {
        $maxKeyLength   = Util::getMaxKeyLength($array);
        $maxValueLength = Util::getMaxValueLength($array);
        $drawBorders    = ($structure->getBorder()) ? true : false;
        $insertTab = ($structure->getTab()) ? true : false;

        if ($drawBorders) {
            $firstLine = static::printBorder($structure->getBorder(), $maxKeyLength, $maxValueLength);
            if ($insertTab) {
                $firstLine = $structure->getTab() . $firstLine;
            }
        } else {
            $firstLine = '';
        }

        $lines = '';
        foreach ($array as $key => $value) {
            $lines .= static::printStructureLine($key, $value, $structure, $maxKeyLength, $maxValueLength);
        }

        $lastLine = $firstLine;
        $result   = $firstLine . $lines . $lastLine;

        return $result;
    }

    private static function printBorder(Border $border, $maxKeyLength, $maxValueLength)
    {
        $result = '';

        $keyBorderLine   = Util::buildPatternLine($border->getLineCharacter(), $maxKeyLength + 2);
        $valueBorderLine = Util::buildPatternLine($border->getLineCharacter(), $maxValueLength + 2);

        $result .= $border->getCrossCharacter() . $keyBorderLine . $border->getCrossCharacter();
        $result .= $valueBorderLine . $border->getCrossCharacter() . PHP_EOL;

        return $result;
    }

    private static function printStructureLine($key, $value, Structure $structure, $maxKeyLength, $maxValueLength)
    {
        $result = '';
        $insertTab = ($structure->getTab()) ? true : false;
        $border = $structure->getBorder();

        if ($border) {
            $keyLength        = Util::getVisibleStringLength($key);
            $missingKeyLength = $maxKeyLength - $keyLength;
            $fillingKeySpace  = Util::buildPatternLine(' ', $missingKeyLength);

            $valueLength        = Util::getVisibleStringLength($value);
            $missingValueLength = $maxValueLength - $valueLength;
            $fillingValueSpace  = Util::buildPatternLine(' ', $missingValueLength);

            $result .= ($insertTab ? $structure->getTab() : '');
            $result .= $border->getColumnCharacter() . ' ' . $key . $fillingKeySpace . ' ';
            $result .= $structure->getKeyToValueCharacter() . ' ' . $value . $fillingValueSpace . ' ';
            $result .= $border->getColumnCharacter() . PHP_EOL;
        } else {
            $keyLength        = Util::getVisibleStringLength($key);
            $missingKeyLength = $maxKeyLength - $keyLength;
            $fillingKeySpace  = Util::buildPatternLine(' ', $missingKeyLength);

            $result .= ($insertTab ? $structure->getTab() : '');
            $result .= $key . $fillingKeySpace . ' ';
            $result .= $structure->getKeyToValueCharacter() . ' ' . $value;
            $result .= PHP_EOL;
        }

        return $result;
    }
}
