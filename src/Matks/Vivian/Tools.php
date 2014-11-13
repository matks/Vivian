<?php

namespace Matks\Vivian;

use Matks\Vivian\Border\BorderManager;
use Matks\Vivian\Color\BackgroundColorManager;
use Matks\Vivian\Color\TextColorManager;
use Matks\Vivian\Figlet\FigletManager;
use Matks\Vivian\Structure\StructureManager;
use Matks\Vivian\Style\StyleManager;
use Exception;

class Tools
{
    /**
     * Enable to use functions such as Tools::green('random string')
     *
     * @return string
     */
    public static function __callstatic($name, $params)
    {
        if (array_key_exists($name, TextColorManager::getKnownColors())) {
            return TextColorManager::$name($params);
        }

        if (BackgroundColorManager::isBackgroundCall($name)) {
            return BackgroundColorManager::$name($params);
        }

        if (in_array($name, BorderManager::getKnownBorders())) {
            return BorderManager::$name($params);
        }

        if (in_array($name, StructureManager::getDisplayableStructures())) {
            return StructureManager::$name($params);
        }

        if (array_key_exists($name, StyleManager::getKnownStyles())) {
            return StyleManager::$name($params);
        }

        if (FigletManager::isFigletCall($name)) {
            return FigletManager::$name($params);
        }

        throw new Exception("Unknown function name $name");
    }

}
