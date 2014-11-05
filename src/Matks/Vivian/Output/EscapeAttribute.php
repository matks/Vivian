<?php

namespace Matks\Vivian\Output;

use Exception;

/**
 * ANSI/VT100 Escape attribute
 */
abstract class EscapeAttribute
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @param $name
     * @param $code
     */
    public function __construct($name, $code)
    {
        $escapeCode = "\033[" . $code . "m";

        if (!in_array($escapeCode, $this->getAllowedEscapeCodes())) {
            throw new Exception("Forbidden code $code");
        }

        $this->name = $name;

        $this->code = $escapeCode;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEscapeCode()
    {
        return $this->code;
    }

    /**
     * Get allowed escape codes
     *
     * @return array
     */
    abstract protected function getAllowedEscapeCodes();
}
