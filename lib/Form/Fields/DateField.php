<?php
namespace Tit\lib\Form\Fields;

use Tit\lib\Form\Field;
use Carbon\Carbon;

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
     * Format to transform the value as Carbon object.
     * @var string
     */
    protected $format;

    /**
     * Set the max date.
     * @param float $max
     * @return DateField
     */
    public function setMax(float $max){
    // For php7.1 public function setMax(float $max): DateField{
            $this->max = $max;
        return $this;
    }

    /**
     * Set the min date.
     * @param float $min
     * @return DateField
     */
    public function setMin(float $min){
    // For php7.1 public function setMin(float $min): DateField{
            $this->min = $min;
        return $this;
    }

    /**
     * Set the format for the Carbon objet.
     * @param string $format
     * @return DateField
     */
    public function setFormat(string $format){
    // For php7.1 public function setFormat(string $format): DateField{
            $this->format = $format;
        return $this;
    }

    /**
     * Getter
     * @return string
     */
    public function max(){
    // For php7.1 public function max(): string{
            return $this->max;
    }

    /**
     * Getter
     * @return string
     */
    public function min(){
    // For php7.1 public function min(): string{
            return $this->min;
    }

    /**
     * Getter
     * @return string
     */
    public function format(){
    // For php7.1 public function format(): string{
            return $this->format;
    }

    /**
     * Return the date in a Carbon object
     *
     * @return Carbon
     */
    public function getDate(){
    // For php7.1 public function getDate(): Carbon{
            return Carbon::createFromFormat($this->format, $this->value);
    }

    /**
     * Set the value from a Carbon object.
     * The value is a date.
     *
     * @param Carbon $date
     * @return DateField
     */
    public function setDate(Carbon $date){
        // For php7.1 public function setDate(Carbon $date): DateField{
        $this->value = $date->toDateString();
        return $this;
    }

    /**
     * Set the value from a Carbon object.
     * The value is a time.
     *
     * @param Carbon $date
     * @return DateField
     */
    public function setTime(Carbon $date){
        // For php7.1 public function setDate(Carbon $date): DateField{
        $this->value = $date->toTimeString();
        return $this;
    }

    /**
     * Set the value from a Carbon object.
     * THe value is a date and a time.
     *
     * @param Carbon $date
     * @return DateField
     */
    public function setDateTime(Carbon $date){
        // For php7.1 public function setDate(Carbon $date): DateField{
        $this->value = $date->toDateTimeString();
        return $this;
    }
}