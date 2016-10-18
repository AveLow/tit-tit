<?php
namespace Tit\lib\Form\Fields;

use Tit\lib\Form\Field;

/**
 * Class CheckField
 * @package Tit\lib\Form\Fields
 *
 * Should be used for input type :
 * Checkbox and Radio
 */
class CheckField extends Field
{

    /**
     * Set if the box is checked or not.
     * @var bool
     */
    protected $checked;

    /**
     * Set if the field is checked.
     * @param bool $checked
     * @return Field
     */
    public function setIschecked(bool $checked): Field{
        $this->checked = $checked;
        return $this;
    }

    /**
     * Set if the field is checked.
     * @param bool $checked
     * @return Field
     */
    public function checked(bool $checked): Field{
        $this->checked = $checked;
        return $this;
    }

    /**
     * Set if the field is checked.
     * @param bool $checked
     * @return Field
     */
    public function unchecked(bool $checked): Field{
        $this->checked = $checked;
        return $this;
    }

    /**
     * Getter
     * @return bool
     */
    public function isChecked(): bool{ return $this->checked; }
}