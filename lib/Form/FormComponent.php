<?php
namespace Tit\lib\Form;

use Tit\lib\AppComponent;

/**
 * Class FormComponent
 * @package Tit\lib\Form
 */
abstract class FormComponent extends AppComponent{

    /**
     * Form that will be process.
     * @var Form
     */
    protected $form;

    /**
     * Set the form.
     * @param Form $form
     * @return FormComponent $this
     */
    public function setForm(Form $form): FormComponent{
        $this->form = $form;
        return $this;
    }

    /**
     * Getter
     * @return Form
     */
    public function form(): Form{
        return $this->form;
    }
}
