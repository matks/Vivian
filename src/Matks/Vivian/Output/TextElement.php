<?php

namespace Matks\Vivian\Output;

use Matks\Vivian\Style\Style;
use Exception;

/**
 * Text Element
 *
 * String to be echoed
 */
class TextElement extends Element
{

    /**
     * @var string
     */
    private $text;

    /**
     * @param string $text
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

    /**
     * @return string
     */
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
     * @return string
     */
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
