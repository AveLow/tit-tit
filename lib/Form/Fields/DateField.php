<?php
namespace Tit\lib\Form\Fields;

use Tit\lib\Form\Field;

/**
 * Class DateType
 * @package Tit\lib\Form\Fields
 *
 * Should be used for input type :
 * date, datetime-local and time
 */
class DateField extends Field
{
    /**
     * Min date for the field.
     * @var string
     */
    protected $min;

    /**
     * Max date for the field.
     * @var string
     */
    protected $max;

    /**
     * Set the max date.
     * @param string $max
     * @return DateField
     */
    public function setMax(float $max): DateField{
        $this->max = $max;
        return $this;
    }

    /**
     * Set the min date.
     * @param string $min
     * @return DateField
     */
    public function setMin(float $min): DateField{
        $this->min = $min;
        return $this;
    }

    /**
     * Getter
     * @return string
     */
    public function max(): string{
        return $this->max();
    }

    /**
     * Getter
     * @return string
     */
    public function min(): string{
        return $this->min();
    }
}