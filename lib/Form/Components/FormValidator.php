<?php
namespace Tit\lib\Form\Components;
use Tit\lib\Form\FormComponent;

/**
 * Class FormValidator
 * @package Tit\lib\Form
 */
abstract class FormValidator extends FormComponent {

    /**
     * All the algorithm that will be execute during the process.
     * @return bool
     */
    abstract public function isValid();
    // For php7.1 abstract public function isValid(): bool;
}
