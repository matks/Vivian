<?php

namespace Matks\Vivian\Output;

use Matks\Vivian\Color\BackgroundColor;
use Matks\Vivian\Color\TextColor;
use Matks\Vivian\Style\Style;
use Exception;

/**
 * Element
 *
 * Manageable element
 */
abstract class Element
{
    const ANSI_ESCAPE_CODE_RESET = "\033[0m";
    const ANSI_ESCAPE_CODE_REGEX = '\\033\[[\d]+m';

    /**
     * @var TextColor
     */
    private $textColor;

    /**
     * @var BackgroundColor
     */
    private $backgroundColor;

    /**
     * @var array
     */
    private $styles;

    /**
     * @param BackgroundColor $backgroundColor
     *
     * @return static
     */
    public function setBackgroundColor(BackgroundColor $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return BackgroundColor
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param TextColor $textColor
     *
     * @return static
     */
    public function setTextColor(TextColor $textColor)
    {
        $this->textColor = $textColor;

        return $this;
    }

    /**
     * @return TextColor
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param Style $style
     *
     * @return static
     */
    public function addStyle(Style $style)
    {
        $this->styles[] = $style;

        return $this;
    }

    /**
     * @param Style $style
     *
     * @return static
     */
    public function removeStyle(Style $style)
    {
        $styleKey = null;
        foreach ($this->styles as $key => $currentStyle) {
            if ($currentStyle->equals($style)) {
                $styleKey = $key;
                break;
            }
        }

        if (null === $styleKey) {
            throw new Exception("Style $style is not associated with this element");
        }

        array_splice($this->styles, $styleKey, 1);

        return $this;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    abstract public function render();

    /**
     * Apply escape code to string and close section
     *
     * @param string $string
     * @param string $escapeCharacter
     *
     * @return string
     */
    protected function frame($string, $escapeCharacter)
    {
        $result = $escapeCharacter . $string . static::ANSI_ESCAPE_CODE_RESET;

        return $result;
    }
}
