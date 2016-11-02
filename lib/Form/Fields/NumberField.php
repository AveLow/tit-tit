<?php
namespace Tit\lib\Form\Fields;

use Tit\lib\Form\Field;

/**
 * Class NumberField
 * @package Tit\lib\Form\Fields
 *
 * Should be used for input type :
 * number and range
 */
class NumberField extends Field
{
    /**
     * Min value for the field.
     * @var float
     */
    protected $min;

    /**
     * Max value for the field.
     * @var float
     */
    protected $max;

    /**
     * Step between 2 values.
     * @var float
     */
    protected $step;

    /**
     * Set the max value.
     * @param float $max
     * @return NumberField
     */
    public function setMax(float $max){
    // For php7.1 public function setMax(float $max): NumberField{
            $this->max = $max;
        return $this;
    }

    /**
     * Set the min value.
     * @param float $min
     * @return NumberField
     */
    public function setMin(float $min){
    // For php7.1 public function setMin(float $min): NumberField{
            $this->min = $min;
        return $this;
    }

    /**
     * Set the step between 2 values.
     * @param float $step
     * @return NumberField
     */
    public function setStep(float $step){
    // For php7.1 public function setStep(float $step): NumberField{
            $this->step = $step;
        return $this;
    }

    /**
     * Getter
     * @return float
     */
    public function max(){
    // For php7.1 public function max(): float{
            return $this->max;
    }

    /**
     * Getter
     * @return float
     */
    public function min(){
    // For php7.1 public function min(): float{
            return $this->min;
    }

    /**
     * Getter
     * @return float
     */
    public function step(){
    // For php7.1 public function step(): float{
            return $this->step;
    }
}