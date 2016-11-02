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
    public function setIschecked(bool $checked){
    // For php7.1 public function setIschecked(bool $checked): Field{
            $this->checked = $checked;
        return $this;
    }

    /**
     * Set if the field is checked.
     * @param bool $checked
     * @return Field
     */
    public function checked(){
    // For php7.1 public function checked(): Field{
            $this->checked = true;
        return $this;
    }

    /**
     * Set if the field is checked.
     * @param bool $checked
     * @return Field
     */
    public function unchecked(){
    // For php7.1 public function unchecked(): Field{
            $this->checked = false;
        return $this;
    }

    /**
     * Getter
     * @return bool
     */
    public function isChecked(){ return $this->checked; }
    // For php7.1 public function isChecked(): bool{ return $this->checked; }
}