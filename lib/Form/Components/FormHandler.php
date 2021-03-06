<?php
namespace Tit\lib\Form\Components;
use Slim\App;
use Tit\lib\Components\SessionHandler;
use Tit\lib\Exception\CSRFException;
use Tit\lib\Form\FormComponent;

/**
 * Class FormHandler
 * @package Tit\lib\Form
 */
abstract class FormHandler extends FormComponent {

    /**
     * @var SessionHandler
     */
    protected $session;

    public function __construct(App $app, SessionHandler $session)
    {
        $this->session = $session;
        parent::__construct($app);
    }

    /**
     * All the algorithm that will be execute during the process.
     * @throws CSRFException
     * @return bool
     */
    public function process(){
        if ($this->session->get($this->form->name()) == null ||
            $this->session->get($this->form->name()) != $_POST[$this->form->name()]){
            $this->session->unset($this->form->name());
            throw new CSRFException("tentative attaque csrf");
        }else{
            $this->session->unset($this->form->name());
            return true;
        }
    }
    // For php7.1 abstract public function process(): bool;

    /**
     * Return the html code for the Form.
     * @param array $args
     * @return string
     */
    abstract public function render(array $args);
    // For php7.1 abstract public function render(array $args): string;
}
