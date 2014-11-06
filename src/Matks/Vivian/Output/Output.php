<?php

namespace Matks\Vivian\Output;

class Output
{
    /**
     * @var Element
     */
    private $element;

    /**
     * @var Border
     */
    private $border;

    public function __construct(Element $element)
    {
        $this->element = $element;
    }
}
