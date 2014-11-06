<?php

namespace Matks\Vivian\Output;

use Matks\Vivian\Color\BackgroundColor;
use Matks\Vivian\Color\TextColor;
use Matks\Vivian\Style\Style;
use Exception;

/**
 * Element
 *
 * String to be echoed
 */
class Element
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
     * @var string
     */
    private $text;

    /**
     * @param $text
     */
    public function __construct($text)
    {
        if (!$text) {
            throw new Exception('No text provided');
        }

        if ($this->containsEscapeCharacters($text)) {
            throw new Exception('Given text contains an escape code');
        }

        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

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
        $this->color = $textColor;

        return $this;
    }

    /**
     * @return TextColor
     */
    public function getTextColor()
    {
        return $this->color;
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

    public function render()
    {
        $textIsColored       = ($this->getTextColor() !== null);
        $backgroundIsColored = ($this->getBackgroundColor() !== null);

        $styles          = $this->getStyles();
        $stringHasStyles = (!empty($styles));

        $text = $this->getText();

        if ($textIsColored) {
            $text = $this->frame($text, $this->getTextColor()->getEscapeCharacter());
        }

        if ($backgroundIsColored) {
            $text = $this->frame($text, $this->getBackgroundColor()->getEscapeCharacter());
        }

        if ($stringHasStyles) {
            foreach ($styles as $style) {
                $text = $this->frame($text, $style->getEscapeCharacter());
            }
        }

        return $text;
    }

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

    /**
     * Check if given string contains color escape code
     *
     * @param string $string
     *
     * @return boolean
     */
    private static function containsEscapeCharacters($string)
    {
        $escapeCodePattern = '#' . static::ANSI_ESCAPE_CODE_REGEX . '#';
        $result            = preg_match($escapeCodePattern, $string);

        return (boolean)$result;
    }
}
