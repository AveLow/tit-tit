<?php
namespace Tit\lib\Form\Fields;

use Tit\lib\Form\Field;

/**
 * Class TextField
 * @package Tit\lib\Form\Fields
 *
 * Should be used for input type :
 * text, password, email, search, url, tel
 */
class TextField extends Field
{
    /**
     * Maxlength for the input.
     * @var int
     */
    protected $maxlength;

    /**
     * Pattern that must be in the field to be valid.
     * @var string
     */
    protected $pattern;

    /**
     * Set the maxlength of the field
     * @param int $max
     * @return TextField
     */
    public function setMaxlength(int $max): TextField{
        $this->maxlength = $max;
        return $this;
    }

    public function setPattern(string $pattern): TextField{
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Getter
     * @return int
     */
    public function maxlength(): int{
        return $this->maxlength();
    }

    /**
     * Getter
     * @return string
     */
    public function pattern(): string{
        return $this->pattern();
    }
}