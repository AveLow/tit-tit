<?php
namespace Tit\lib\Form;

use Tit\lib\Entity\Hydratable;

// TODO: Add attribut management for readonly, disabled ...
/**
 * Abstract Class Field
 * @package TiT\lib\Form
 */
abstract class Field{

    use Hydratable;

    /**
     * Name of the field.
     * @var string
     */
    protected $name;

    /**
     * Real Name of the field used in html.
     * If $realName is null, it return the value of $name.
     * @var string
     */
    protected $realName;

    /**
     * Value of the field.
     * @var string
     */
    protected $value;

    /**
     * Label of the field.
     * @var string
     */
    protected $label;

    /**
     * Specify if the field is required.
     * @var bool
     */
    protected $isRequired;

    /**
     * Field constructor.
     * @param array $data
     */
    public function __construct(array $data = array()){
        $this->realName = null;
        $this->hydrate($data);
    }

    /**
     * Set value to null.
     * @return Field $this
     */
    public function unsetValue(){
    // For php7.1 public function unsetValue(): Field{
            $this->value = null;
        return $this;
    }

    /**
     * fill the field with a string value.
     * @param string $value
     * @return Field
     */
    public function fill(string $value){
    // FOr php7.1 public function fill(string $value): Field{
            $this->setValue($value);
        return $this;
    }

    /**
     * Set the value.
     * @param string $value
     * @return Field $this
     */
    public function setValue(string $value){
    // For php7.1 public function setValue(string $value): Field{
            $this->value = $value;
        return $this;
    }

    /**
     * Set the name.
     * @param string $name
     * @return Field $this
     */
    public function setName(string $name){
    // For php7.1 public function setName(string $name): Field{
            $this->name = $name;
        return $this;
    }

    /**
     * Set the real name.
     * @param string $name
     * @return Field $this
     */
    public function setRealName(string $name){
    // For php7.1 public function setRealName(string $name): Field{
            $this->realName = $name;
        return $this;
    }

    /**
     * Set the label.
     * @param string $label
     * @return Field $this
     */
    public function setLabel(string $label){
    // For php7.1 public function setLabel(string $label): Field{
            $this->label = $label;
        return $this;
    }

    /**
     * Set if the field is required.
     * @param bool $required
     * @return Field
     */
    public function setIsRequired(bool $required){
    // For php7.1 public function setIsRequired(bool $required): Field{
            $this->isRequired = $required;
        return $this;
    }

    /**
     * Getter
     * @return string
     */
    public function name(){ return $this->name; }
    // For php7.1 public function name(): string{ return $this->name; }

    /**
     * Getter
     * Return realName of name if realName is null.
     * @return string
     */
    public function realName(){ return $this->realName ?? $this->name; }
    // For php7.1 public function realName(): string{ return $this->realName ?? $this->name; }

    /**
     * Getter
     * @return string
     */
    public function value(){ return $this->value; }
    // For php7.1 public function value(): string{ return $this->value; }

    /**
     * Getter
     * @return string
     */
    public function label(){ return $this->label; }
    // For php7.1 public function label(): string{ return $this->label; }

    /**
     * Getter
     * @return bool
     */
    public function isRequired(){ return $this->isRequired; }
    // For php7.1 public function isRequired(): bool{ return $this->isRequired; }
}
