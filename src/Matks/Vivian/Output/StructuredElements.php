<?php

namespace Matks\Vivian\Output;

use Matks\Vivian\Structure\Structure;
use Matks\Vivian\Structure\StructureManager;

/**
 * Structured Elements
 *
 * Array of TextElements to be echoed printed in a structured way
 */
class StructuredElements
{

    /**
     * @var TextElement[]
     */
    private $elements;

    /**
     * @var Structure
     */
    private $structure;

    /**
     * @param TextElement[] $elements
     * @param Structure     $structure
     */
    public function __construct(array $elements, Structure $structure)
    {
        foreach($elements as $element) {
            if (!($element instanceOf \Matks\Vivian\Output\TextElement)) {
                throw new \InvalidArgumentException('Provided array should contain only TextElement, '.get_class($element).' provided instead');
            }
        }

        $this->elements  = $elements;
        $this->structure = $structure;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @return Structure
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Render structured element
     *
     * @return string
     */
    public function render()
    {
        $renderFunction = function(&$element, $key) {
            $element = $element->render();
        };
        array_walk($this->elements, $renderFunction);

        $structuredElements = StructureManager::buildStructure($this->elements, $this->structure);

        return $structuredElements;
    }
}
