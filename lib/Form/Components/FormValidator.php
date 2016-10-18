<?php
namespace Tit\lib\Form\Components;

/**
 * Class FormValidator
 * @package Tit\lib\Form
 */
abstract class FormValidator extends FormComponent{

    /**
     * All the algorithm that will be execute during the process.
     * @return bool
     */
    abstract public function isValid() :bool;
}
