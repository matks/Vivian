<?php

namespace Matks\Vivian\Border;

use Matks\Vivian\Output\BorderedElement;
use Matks\Vivian\Util;
use Exception;

/**
 * Border manager
 */
class BorderManager
{
    const STYLE_UNDERLINE        = 'underlineBorder';
    const STYLE_DOUBLE_UNDERLINE = 'doubleUnderlineBorder';
    const STYLE_BORDER           = 'border';
    const STYLE_DOUBLE_BORDER    = 'doubleBorder';

    /**
     * Static calls interface
     */
    public static function __callstatic($name, $params)
    {
        if (!in_array($name, static::getKnownBorders())) {
            throw new Exception("Unknown border function name $name");
        }

        // target string is expected to be:
        $targetString = $params[0][0];
        $functionName = '__' . $name;

        return static::$functionName($targetString);
    }

    /**
     * Get known borders
     *
     * @return array
     */
    public static function getKnownBorders()
    {
        $styles = array(
            static::STYLE_UNDERLINE,
            static::STYLE_DOUBLE_UNDERLINE,
            static::STYLE_BORDER,
            static::STYLE_DOUBLE_BORDER
        );

        return $styles;
    }

    /**
     * Render bordered string
     *
     * @param string $string
     * @param Border $border
     *
     * @return string
     * @throws Exception
     */
    public static function buildBorder($string, Border $border)
    {
        switch ($border->getType()) {
            case Border::TYPE_UNDERLINE:
                $result = static::buildUnderline($string, $border);
                break;
            case Border::TYPE_FRAME:
                $result = static::buildFrame($string, $border);
                break;
            default:
                throw new Exception('Unknown border type ' . $border->getType());
        }

        return $result;
    }

    /**
     * Underline with the given Border the given string
     *
     * @param string $string
     * @param Border $border
     *
     * @return string
     */
    private static function buildUnderline($string, Border $border)
    {
        $stringLength = Util::getVisibleStringLength($string);
        $underline    = Util::buildPatternLine($border->getLineCharacter(), $stringLength);

        $result = $string . PHP_EOL . $underline . PHP_EOL;

        return $result;
    }

    /**
     * Frame with the given Border the given string
     *
     * @param string $string
     * @param Border $border
     *
     * @return string
     */
    private static function buildFrame($string, Border $border)
    {
        $stringLength = Util::getVisibleStringLength($string);

        $line = Util::buildPatternLine($border->getLineCharacter(), $stringLength + 2);

        $firstLine = $border->getCrossCharacter() . $line . $border->getCrossCharacter();
        $mainLine  = $border->getColumnCharacter() . ' ' . $string . ' ' . $border->getColumnCharacter();
        $lastLine  = $firstLine;

        $result = $firstLine . PHP_EOL . $mainLine . PHP_EOL . $lastLine . PHP_EOL;

        return $result;
    }

    /**
     * Underline a string with '-'
     *
     * Be careful, this adds two end-of-line
     *
     * @param string $string
     *
     * @return string
     */
    private static function __underlineBorder($string)
    {
        $border          = new Border(Border::TYPE_UNDERLINE);
        $borderedElement = new BorderedElement($string, $border);

        return $borderedElement->render();
    }

    /**
     * Underline a string with '='
     *
     * Be careful, this adds two end-of-line
     *
     * @param string $string
     *
     * @return string
     */
    private static function __doubleUnderlineBorder($string)
    {
        $border          = new Border(Border::TYPE_UNDERLINE, '=');
        $borderedElement = new BorderedElement($string, $border);

        return $borderedElement->render();
    }

    /**
     * Draw a border around a string
     *
     * @param string $string
     *
     * @return string
     */
    private static function __border($string)
    {
        $border          = new Border(Border::TYPE_FRAME);
        $borderedElement = new BorderedElement($string, $border);

        return $borderedElement->render();
    }

    /**
     * Draw a double border around a string
     *
     * @param string $string
     *
     * @return string
     */
    private static function __doubleBorder($string)
    {
        $border          = new Border(Border::TYPE_FRAME, '=', '#', '*');
        $borderedElement = new BorderedElement($string, $border);

        return $borderedElement->render();
    }
}
