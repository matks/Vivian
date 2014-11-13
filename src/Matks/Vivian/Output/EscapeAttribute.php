<?php

namespace Matks\Vivian\Output;

use Exception;

/**
 * ANSI/VT100 Escape attribute
 */
abstract class EscapeAttribute
{
    const ANSI_ESCAPE_CODE_BEGIN = "\033[";
    const ANSI_ESCAPE_CODE_END   = 'm';

    /**
     * @var string
     */
    private $escapeCharacter;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        if (!in_array($code, $this->getAllowedEscapeCodes())) {
            throw new Exception("Forbidden code $code");
        }

        $escapeCharacter       = $this->buildEscapeCharacter($code);
        $this->escapeCharacter = $escapeCharacter;
    }

    /**
     * @return string
     */
    public function getEscapeCharacter()
    {
        return $this->escapeCharacter;
    }

    /**
     * @param EscapeAttribute $escapeAttribute
     *
     * @return bool
     */
    public function equals(EscapeAttribute $escapeAttribute)
    {
        return ($escapeAttribute->getEscapeCharacter() === $this->getEscapeCharacter());
    }

    /**
     * Build escape character to be print
     *
     * @param string $escapeCode
     *
     * @return string
     */
    protected function buildEscapeCharacter($escapeCode)
    {
        $result = static::ANSI_ESCAPE_CODE_BEGIN . $escapeCode . static::ANSI_ESCAPE_CODE_END;

        return $result;
    }

    /**
     * Get allowed escape codes
     *
     * @return string[]
     */
    abstract protected function getAllowedEscapeCodes();
}
