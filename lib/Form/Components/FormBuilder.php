<?php
namespace Tit\lib\Form\Components;

use Tit\lib\Form\Form;
use Tit\lib\Form\FormComponent;
use Slim\App;

/**
 * Class FormBuilder
 * @package Tit\lib\Form
 */
abstract class FormBuilder extends FormComponent {

    /**
     * FormBuilder constructor.
     * @param App $slim
     */
    public function __construct(App $slim){
        parent::__construct($slim);
        $this->build();
    }

    /**
     * Build the Form.
     */
    abstract public function build();
    // For php7.1abstract public function build(): void;

    /**
     * Fill the form with an array and return it.
     * @param array $data
     * @return Form
     */
    abstract public function fill(array $data);
    // For php7.1 abstract public function fill(array $data): Form;

}
