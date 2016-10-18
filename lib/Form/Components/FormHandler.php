<?php
namespace Tit\lib\Form\Components;

/**
 * Class FormHandler
 * @package Tit\lib\Form
 */
abstract class FormHandler extends FormComponent{

    /**
     * All the algorithm that will be execute during the process.
     * @return bool
     */
    abstract public function process() :bool;

    /**
     * Return the html code for the Form.
     * @param array $args
     * @return string
     */
    abstract public function render(array $args): string;
}
