<?php

namespace Matks\Vivian\Border;

use Exception;

/**
 * Border element
 */
class Border
{
    const TYPE_UNDERLINE = 'underline';
    const TYPE_FRAME     = 'frame';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $lineCharacter;

    /**
     * @var string
     */
    private $columnCharacter;

    /**
     * @var string
     */
    private $crossCharacter;

    /**
     * @param string $borderType
     * @param string $lineCharacter
     * @param string $columnCharacter
     * @param string $crossCharacter
     */
    public function __construct($type, $lineCharacter = '-', $columnCharacter = '|', $crossCharacter = '+')
    {
        if (!in_array($type, $this->getAllowedTypes())) {
            throw new Exception("Unknown border type $type");
        }

        $this->type            = $type;
        $this->lineCharacter   = $lineCharacter;
        $this->columnCharacter = $columnCharacter;
        $this->crossCharacter  = $crossCharacter;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getColumnCharacter()
    {
        return $this->columnCharacter;
    }

    /**
     * @return string
     */
    public function getCrossCharacter()
    {
        return $this->crossCharacter;
    }

    /**
     * @return string
     */
    public function getLineCharacter()
    {
        return $this->lineCharacter;
    }

    /**
     * @return array
     */
    private function getAllowedTypes()
    {
        $types = array(
            static::TYPE_UNDERLINE,
            static::TYPE_FRAME,
        );

        return $types;
    }
}
