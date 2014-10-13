<?php

namespace Matks\Vivian;

use Matks\Vivian\Color\Color;
use Matks\Vivian\Style\Style;
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

        if (in_array($name, Style::getKnownStyles())) {
            return Style::$name($params);
        }

        if (in_array($name, Structure::getDisplayableStructures())) {
            return Structure::$name($params);
        }

        throw new Exception("Unknown function name $name");
    }

}
