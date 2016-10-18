<?php
namespace Tit\lib\Form\Validators;

use Tit\lib\AppComponent;
use Tit\lib\Form\Field;
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
    public static function isNotNull(Field $field): bool{
        return !empty($field->value()) && $field->value() !== null;
    }

    /**
     * Field Validator
     * Check if the field is required and not null.
     *
     * @param Field $field
     * @return bool
     */
    public static function checkRequired(Field $field): bool{
        return $field->isRequired() ? self::isNotNull($field) : true;
    }

    /**
     * TextField Validator
     * Check if the maxlength attribute is respected.
     *
     * @param TextField $field
     * @return bool
     */
    public static function checkMaxlength(TextField $field): bool{
        return strlen($field->value()) <= $field->maxlength();
    }

    /**
     * TextField Validator
     * Check if the pattern attribute is respected.
     *
     * @param TextField $field
     * @return bool
     */
    public static function checkPattern(TextField $field): bool{
        $pattern = '/'.$field->pattern().'/';
    }
}
