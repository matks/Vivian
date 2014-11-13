<?php

namespace Matks\Vivian\Structure;

use Matks\Vivian\Border\Border;
use Exception;

/**
 * Border element
 */
class Structure
{
    const TYPE_LIST  = 'list';
    const TYPE_ARRAY = 'array';

    const FOUR_SPACE_TAB = '    ';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $tab;

    /**
     * @var string
     */
    private $iteratorCharacter;

    /**
     * @var string
     */
    private $keyToValueCharacter;

    /**
     * @var Border
     */
    private $border;

    /**
     * @param string $type
     * @param string $iteratorCharacter
     * @param string $tab
     * @param string $keyToValueCharacter
     * @param Border $border
     */
    public function __construct(
        $type,
        $iteratorCharacter = '#',
        $tab = null,
        $keyToValueCharacter = '|',
        Border $border = null
    )
    {
        if (!in_array($type, $this->getAllowedTypes())) {
            throw new Exception("Unknown structure type $type");
        }

        $this->type                = $type;
        $this->iteratorCharacter   = $iteratorCharacter;
        $this->tab                 = $tab;
        $this->keyToValueCharacter = $keyToValueCharacter;
        $this->border              = $border;
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
    public function getKeyToValueCharacter()
    {
        return $this->keyToValueCharacter;
    }

    /**
     * @return string
     */
    public function getIteratorCharacter()
    {
        return $this->iteratorCharacter;
    }

    /**
     * @return string
     */
    public function getTab()
    {
        return $this->tab;
    }

    /**
     * @return Border
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * @return string[]
     */
    private function getAllowedTypes()
    {
        $types = array(
            static::TYPE_LIST,
            static::TYPE_ARRAY,
        );

        return $types;
    }
}
