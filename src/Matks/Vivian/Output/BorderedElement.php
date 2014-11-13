<?php

namespace Matks\Vivian\Output;

use Matks\Vivian\Border\Border;
use Matks\Vivian\Border\BorderManager;

/**
 * Bordered Element
 *
 * String to be echoed with a border to draw
 */
class BorderedElement extends TextElement
{

    /**
     * @var Border
     */
    private $border;

    /**
     * @param string $text
     * @param Border $border
     */
    public function __construct($text, Border $border)
    {
        parent::__construct($text);

        $this->border = $border;
    }

    /**
     * @return Border
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * Render bordered element
     *
     * @return string
     */
    public function render()
    {
        $text         = parent::render();
        $borderedText = BorderManager::buildBorder($text, $this->border);

        return $borderedText;
    }
}
