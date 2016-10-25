<?php
namespace Tit\lib\Form\Validators;

use Carbon\Carbon;
use Tit\lib\AppComponent;
use Tit\lib\Form\Field;
use Tit\lib\Form\Fields\CheckField;
use Tit\lib\Form\Fields\DateField;
use Tit\lib\Form\Fields\NumberField;
use Tit\lib\Form\Fields\TextField;

/**
 * Class BasicValidator
 * @package Tit\lib\Form
 */
class BasicValidator extends AppComponent{

    /**
     * Field Validator
     * Check if the value is not null.
     *
     * @param Field $field
     * @return bool
     */
    public static function isNotNull(Field $field){
    // For php7.1 public static function isNotNull(Field $field): bool{
            return !empty($field->value()) && $field->value() !== null;
    }

    /**
     * Field Validator
     * Check if the field is required and not null.
     *
     * @param Field $field
     * @return bool
     */
    public static function checkRequired(Field $field){
    // For php7.1 public static function checkRequired(Field $field): bool{
            return $field->isRequired() ? self::isNotNull($field) : true;
    }

    /**
     * TextField Validator
     * Check if the maxlength attribute is respected.
     *
     * @param TextField $field
     * @return bool
     */
    public static function checkMaxlength(TextField $field){
    // For php7.1 public static function checkMaxlength(TextField $field): bool{
            return strlen($field->value()) <= $field->maxlength();
    }

    /**
     * TextField Validator
     * Check if the pattern attribute is respected.
     *
     * @param TextField $field
     * @return bool
     */
    public static function checkPattern(TextField $field){
    // For php7.1 public static function checkPattern(TextField $field): bool{
            $pattern = '/'.$field->pattern().'/';

        return preg_match($pattern, $field->value());
    }

    /**
     * NumberField Validator
     * Check if the value is higher or equal than the min.
     *
     * @param NumberField $field
     * @return bool
     */
    public static function checkMin(NumberField $field){
    // For php7.1 public static function checkMin(NumberField $field): bool{
            return $field->value() >= $field->min();
    }

    /**
     * NumberField Validator
     * Check if the value is lower or equal than the max.
     *
     * @param NumberField $field
     * @return bool
     */
    public static function checkMax(NumberField $field){
    // For php7.1 public static function checkMax(NumberField $field): bool{
            return $field->value() <= $field->max();
    }

    /**
     * NumberField Validator
     * Check if the value is in the range, between min and max.
     *
     * @param NumberField $field
     * @return bool
     */
    public static function checkInRange(NumberField $field){
    // For php7.1 public static function checkInRange(NumberField $field): bool{
            return self::checkMax($field) && self::checkMin($field);
    }

    /**
     * NumberField Validator
     * Check if the step is respected.
     *
     * @param NumberField $field
     * @return bool
     */
    public static function checkStep(NumberField $field){
    // For php7.1 public static function checkStep(NumberField $field): bool{
            return $field->value()%$field->step() == 0;
    }

    /**
     * DateField Validator
     * Check if the date is in a correct format.
     *
     * @param DateField $field
     * @return bool
     */
    public static function checkFormatDate(DateField $field){
    // For php7.1 public static function checkFormatDate(DateField $field): bool{
            try{
            Carbon::createFromFormat($field->format(), $field->value());
            return true;
        }catch(\InvalidArgumentException $e){
            return false;
        }
    }

    /**
     * DateField Validator
     * Date should be in a correct format to perform this test.
     * Compare if the date is greater or equal than the min date
     *
     * @param DateField $field
     * @return bool
     */
    public static function checkDateMin(DateField $field){
    // For php7.1 public static function checkDateMin(DateField $field): bool{
            $date = Carbon::createFromFormat($field->format(), $field->value());
        $minDate =  Carbon::createFromFormat($field->format(), $field->min());

        return $minDate->lte($date);
    }

    /**
     * DateField Validator
     * Date should be in a correct format to perform this test.
     * Compare if the date is greater or equal than the min date
     *
     * @param DateField $field
     * @return bool
     */
    public static function checkDateMax(DateField $field){
    // For php7.1 public static function checkDateMax(DateField $field): bool{
            $date = Carbon::createFromFormat($field->format(), $field->value());
        $maxDate =  Carbon::createFromFormat($field->format(), $field->min());

        return $maxDate->gte($date);
    }

    /**
     * CheckField Validator
     * Return true if the box is checked.
     *
     * @param CheckField $field
     * @return bool
     */
    public static function isChecked(CheckField $field){
    // For php7.1 public static function isChecked(CheckField $field): bool{
            return $field->isChecked();
    }

    /**
     * CheckFieldValidator
     * Return true if at least one field is checked.
     *
     * @param array $fields
     * @return bool
     */
    public static function atLeastOneChecked(array $fields){
    // For php7.1 public static function atLeastOneChecked(array $fields): bool{
            foreach ($fields as $field){
            if ($field->isChecked())
                return true;
        }
        return false;
    }
}
