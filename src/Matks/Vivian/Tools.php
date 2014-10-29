<?php

namespace Matks\Vivian;

use Matks\Vivian\Color\Color;
use Matks\Vivian\Border\Border;
use Matks\Vivian\Structure\Structure;
use Exception;

class Tools
{
    /**
     * Enable to use functions such as Tools::green('random string')
     */
    public static function __callstatic($name, $params)
    {
        if (array_key_exists($name, Color::getKnownColors())) {
            return Color::$name($params);
        }

        if (in_array($name, Border::getKnownBorders())) {
            return Border::$name($params);
        }

        if (in_array($name, Structure::getDisplayableStructures())) {
            return Structure::$name($params);
        }

        throw new Exception("Unknown function name $name");
    }

}
